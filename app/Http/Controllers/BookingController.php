<?php

namespace App\Http\Controllers;

use App\Events\ReservationCheckEvent;
use App\Http\Requests\BookingRequest;
use App\Models\BookedRoom;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->id();
        if (session()->has('booking_' . $userId) && !empty(session()->get('booking_' . $userId))) {
            $reserves = session()->get('booking_' . $userId);
            return view('home.card.index', compact('reserves'));
        } else {
            return redirect()->route('hotel')->with('message', [
                'type' => "info",
                'body' => 'ابتدا رزرو نمایید',
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookingRequest $request)
    {
        $userId = auth()->id();
        $room = Room::findOrFail($request->room_id);
        $totalRoom = $room->total_rooms;
        $subtotal = Carbon::parse($request->check_out)->diffInDays(Carbon::parse($request->check_in)) * $room->price;
        $data = [
            'name' => $room->name,
            'main_photo' => $room->main_photo,
            'price' => $room->price,
            'room_id' => $request->room_id,
            'adult' => $request->adult,
            'children' => $request->children,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'subtotal' => $subtotal
        ];
        $checkIn = $data['check_in'];
        $checkOut = $data['check_out'];
        $dates = getDates($checkIn, $checkOut);
        $bookedDates = BookedRoom::where('room_id', $data['room_id'])->whereIn('booked_date', $dates)->pluck('booked_date')->toArray();
        // check with dates in room_books table
        foreach ($bookedDates as $date) {
            $bookedDateCount = array_count_values($bookedDates)[$date];
            if ($bookedDateCount >= $totalRoom) {
                return redirect()->to(url()->previous() . '#reserved')->with('message', [
                    'type' => "danger",
                    'body' => " اتاق انتخاب شده در تاریخ $date  رزرو می باشد ",
                ]);
            }
        }
        // check dates with dates in room_books table & reserve list
        if (session('booking_' . $userId)) {
            $reservedOrders = collect(session('booking_' . $userId));
            $roomIds = $reservedOrders->pluck('room_id')->toArray();
            if (in_array($data['room_id'], $roomIds)) {
                $datesReserved = $this->getReservedDates($reservedOrders, $bookedDates, $data['room_id']);
                foreach ($dates as $date) {
                    $bookedDateCount = array_count_values($datesReserved)[$date] ?? 0;
                    if ($bookedDateCount >= $totalRoom) {
                        return redirect()->to(url()->previous() . '#reserved')->with('message', [
                            'type' => "danger",
                            'body' => " اتاق انتخاب شده در تاریخ $date  رزرو می باشد ",
                        ]);
                    }
                }
            }
        }
        session()->push('booking_' . $userId, $data);
        return redirect()->to(url()->previous() . '#reserved')->with('message', [
            'type' => "success",
            'body' => 'اتاق انتخاب شده به لیست رزرو اضافه شد',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        $userId = auth()->id();
        $reserves = session()->get('booking_' . $userId);
        if (!$reserves) {
            return redirect()->route('hotel')->with('message', [
                'type' => "info",
                'body' => 'ابتدا رزرو نمایید',
            ]);
        }
        try {
            event(new ReservationCheckEvent($reserves));

        } catch (\Exception $e) {
            return redirect()->back()->with('message', [
                'type' => "danger",
                'body' => $e->getMessage(),
            ]);
        }
        return view('home.card.checkout', compact('reserves'));
    }

    /**
     * Get reserved dates form card for a specific room.
     * @param \Illuminate\Support\Collection $reservedOrders
     * @param array $bookedDates
     * @param int $roomId
     * @return array
     */
    function getReservedDates($reservedOrders, $bookedDates, $roomId)
    {
        $datesReserved = $reservedOrders
            ->where('room_id', $roomId)
            ->flatMap(function ($item) {
                $checkIn = Carbon::parse($item['check_in'])->format('Y/m/d');
                $checkOut = Carbon::parse($item['check_out'])->format('Y/m/d');
                $dates = getDates($checkIn, $checkOut);
                return $dates;
            })
            ->merge($bookedDates)
            ->toArray();
        return $datesReserved;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userId = auth()->id();
        if (session()->has('booking_' . $userId) && !empty(session()->get('booking_' . $userId))) {
            session()->pull("booking_$userId." . $id);
            return redirect()->back()->with('message', [
                'type' => "success",
                'body' => 'مورد انتخاب شده از لیست رزرو حذف گردید',
            ]);
        }
        if (empty(session()->get('booking_' . $userId))) {
            session()->forget('booking_' . $userId);
            return redirect()->route('hotel')->with('message', [
                'type' => "info",
                'body' => 'لیست رزرو خالی می باشد',
            ]);
        }
    }
}












