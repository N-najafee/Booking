<?php

namespace App\paymentGetWay;

use App\Events\ReservationCheckEvent;
use App\Http\constants\Constants;
use App\Models\BookedRoom;
use App\Models\Order;
use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CreatePayment
{
    /**
     * @param int
     * @param int
     * @param string
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function create_order($totalAmount, $authority, $type, $user)
    {
        $user->orders()->create([
            'order_number' => md5($authority),
            'transaction_no' => $authority,
            'payment_type' => $type,
            'paid_amount' => $totalAmount,
            'booking_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'status' => Constants::ORDER_UNSUCCESSFUL,
        ]);
        return ['success' => "سفارش با موفقیت ایجاد گردید"];
    }

    /**
     * @param array
     * @param int
     * @return \Illuminate\Http\Response
     */

    public function update_order($reserves, $authority)
    {
        try {
            DB::beginTransaction();
            try {
                event(new ReservationCheckEvent($reserves));
            } catch (\Exception $e) {
                DB::rollBack();
                return ['error' => $e->getMessage()];
            }

            $order = Order::with('orderDetails')->where('transaction_no', $authority)->first();
            $order->update([
                'booking_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'status' => Constants::ORDER_SUCCESSFUL,
            ]);
            $orderDetails = collect($reserves)->map(function ($item) {
                return [
                    'room_id' => $item['room_id'],
                    'checkin_date' => $item['check_in'],
                    'checkout_date' => $item['check_out'],
                    'adult' => $item['adult'],
                    'children' => $item['children'],
                    'subtotal' => $item['subtotal'],
                ];
            })->toArray();
            $order->orderDetails()->createMany($orderDetails);
            $bookedRooms = [];
            foreach ($reserves as $item) {
                $checkIn = Carbon::parse($item['check_in'])->format('Y/m/d');
                $checkOut = Carbon::parse($item['check_out'])->format('Y/m/d');
                while ($checkIn < $checkOut) {
                    $bookedRooms[] = [
                        'room_id' => $item['room_id'],
                        'order_id' => $order->id,
                        'booked_date' => $checkIn,
                    ];
                    $checkIn = Carbon::parse($checkIn)->addDay()->format('Y/m/d');
                }
            }
            $order->bookedRooms()->createMany($bookedRooms);
            DB::commit();
            return ['success' => "رزرو و پرداخت با موفقیت انجام شد"];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['error' => $e->getMessage()];
        }
    }
}
