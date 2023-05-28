<?php

namespace App\Listeners;

use App\Models\Room;

class ReservationCheckListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */

    public function handle($event)
    {
        $reserves = collect($event->reserves);
        $roomIds = $reserves->pluck('room_id')->toArray();
        $groupedReserves = $reserves->groupBy('room_id');
        $rooms = Room::with('bookedRooms')->whereIn('id', $roomIds)->get()->keyBy('id');
        foreach ($groupedReserves as $roomId => $roomReserves) {
            $room = $rooms->get($roomId);
            $totalRoom = $room->total_rooms;
            $dates = $roomReserves->flatMap(function ($reserve) {
                $checkIn = $reserve['check_in'];
                $checkOut = $reserve['check_out'];
                return getDates($checkIn, $checkOut);
            })->toArray();
            $bookedDates = $room->bookedRooms->whereIn('booked_date', array_unique($dates))->pluck('booked_date')->toArray();
            $allBookedDates = array_merge_recursive($dates, $bookedDates);
            foreach ($bookedDates as $date) {
                $bookedDateCount = array_count_values($allBookedDates)[$date];
                if ($bookedDateCount > $totalRoom) {
                    throw new \Exception("اتاق انتخاب شده در تاریخ $date رزرو می باشد");
                }
            }
        }
    }
}
