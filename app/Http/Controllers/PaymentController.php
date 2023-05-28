<?php

namespace App\Http\Controllers;

use App\Events\ReservationCheckEvent;
use App\paymentGeteway\Zarinpal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function payment_store(Request $request)
    {

        $validator = validator::make($request->all(), [
            'payment-type' => 'required',
            'user' => 'required',
            'total' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('message', [
                'type' => 'danger',
                'body' => "خطا در اطلاعات ارسال شده"
            ]);
        }
        $user = auth()->user();
        $userId = $user->id;
        $booking = session('booking_' . $userId);
        $totalAmount = array_sum(collect($booking)->pluck('subtotal')->toArray());
        $checkList = $this->check();
        if (array_key_exists('error', $checkList)) {
            return redirect()->route('booking.index')->with('message', [
                'type' => 'danger',
                'body' => $checkList['error']
            ]);
        }
        $zarinPalGateway = new Zarinpal();
        $result = $zarinPalGateway->send($totalAmount, "تست", $user);
        if (array_key_exists('error', $result)) {
            return redirect()->route('hotel')->with('message', [
                'type' => 'danger',
                'body' => $result['error']
            ]);
        } else {
            return redirect()->to($result['success']);
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param int
     * @return \Illuminate\Http\Response
     */
    public function payment_verify(Request $request, $totalAmount)
    {
        $zarinPalGateway = new Zarinpal();
        $result = $zarinPalGateway->verify($request->Authority, $totalAmount);
        if (array_key_exists('error', $result)) {
            return redirect()->route('hotel')->with('message', [
                'type' => 'danger',
                'body' => $result['error']
            ]);
        } else {
            return redirect()->route('hotel')->with('message', [
                'type' => 'success',
                'body' => $result['success']
            ]);
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function check()
    {
        $userId = auth()->id();
        $reserves = session('booking_' . $userId);
        if (empty($reserves)) {
            return ['error' => "لیست رزرو شما خالی است"];
        }
        try {
            event(new ReservationCheckEvent($reserves));
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
        return ['success' => "ادامه فرایند"];
    }
}




