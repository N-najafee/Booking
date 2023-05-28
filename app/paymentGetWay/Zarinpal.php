<?php

namespace App\paymentGetWay;

use App\Http\constants\Constants;
use App\Mail\PaymentMail;
use Illuminate\Support\Facades\Mail;

class Zarinpal extends CreatePayment implements GetWayInterface
{
    public function send($totalAmount, $description, $user)
    {
        $data = array(
            'MerchantID' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
            'Amount' => $totalAmount,
            'CallbackURL' => route('paymentCreate.verify', ['totalAmount' => $totalAmount]),
            'Description' => $description
        );
        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        $type = Constants::ZARINPAL;
        if ($err) {
            return ['error' => "cURL Error #:" . $err];
        } else {
            if ($result["Status"] == 100) {
                //insert data to order table
                Parent::create_order($totalAmount, $result["Authority"], $type, $user);
                return ['success' => 'https://sandbox.zarinpal.com/pg/StartPay/' . $result["Authority"]];
            } else {
                return ['error' => 'ERR: ' . $result["Status"]];
            }
        }

    }
    public function verify($authority, $totalAmount)
    {
        $MerchantID = 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx';
        $Authority = $authority;
        $data = array('MerchantID' => $MerchantID, 'Authority' => $Authority, 'Amount' => $totalAmount);
        $jsonData = json_encode($data);
        $ch = curl_init('https://sandbox.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);

        if ($err) {
            return ['error' => "cURL Error #:" . $err];
        } else {
            if ($result['Status'] === 100) {
                $user = auth()->user();
                $userId = $user->id;
                $reserves = session('booking_' . $userId);
                session()->forget('booking_' . $userId);
                //update order and create order details
                $updateOrder = Parent::update_order($reserves, $authority);
                if (array_key_exists('error', $updateOrder)) {
                    return ['error' => $updateOrder['error']];
                }
                try {
                    Mail::send(new PaymentMail($user, $reserves, $totalAmount, $authority));
                    return ['success' => $updateOrder['success'] . " : " . $result['RefID']];
                } catch (\Exception $e) {
                    return ['error' => $e->getMessage() . "رزرو و پرداخت با موفقیت انجام شد و خطا در ارسال ایمیل می باشد"];
                }
            } else {
                return ['error' => 'Transaction failed. Status:' . $result['Status']];
            }
        }
    }
}
