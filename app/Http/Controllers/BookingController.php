<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Partner;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    public function showBooking(Place $place)
    {
        $bookings = Booking::with(['place'])
            ->where('place_id', $place->id)
            ->whereIn('status', ['confirmed', 'complete'])
            ->get();

        $events = $bookings->map(function ($booking) {
            return [
                'title' => "Already booking by " . $booking->user->name,
                'start' => $booking->booking_start_time,
                'end'   => $booking->booking_end_time,
                'backgroundColor' => '#f87171',
                'textColor' => '#000000',
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'place_id' => 'required|exists:places,id',
        ]);

        $bookingStart = Carbon::parse($request->date . ' ' . $request->start_time);
        $bookingEnd = Carbon::parse($request->date . ' ' . $request->end_time);

        $conflict = Booking::where('place_id', $request->place_id)
        ->where(function ($query) use ($bookingStart, $bookingEnd) {
            $query->whereBetween('booking_start_time', [$bookingStart, $bookingEnd])
                  ->orWhereBetween('booking_end_time', [$bookingStart, $bookingEnd])
                  ->orWhere(function ($query) use ($bookingStart, $bookingEnd) {
                      $query->where('booking_start_time', '<=', $bookingStart)
                            ->where('booking_end_time', '>=', $bookingEnd);
                  });
        })
        ->whereIn('status', ['pending', 'confirmed']) // hanya booking aktif
        ->exists();

        if ($conflict) {
            return back()->withErrors(['start_time' => 'This time has been booked.']);
        }

        Booking::create([
            'user_id' => auth()->user()->id,
            'place_id' => $request->place_id,
            'booking_start_time' => $bookingStart,
            'booking_end_time' => $bookingEnd,
            'status' => 'pending',
        ]);

        return redirect('/')->with('success', 'Booking successfully added');
    }

    public function myBookings()
    {
        $bookings = auth()->user()->bookings;
        return view('bookings', compact('bookings'));
    }

    public function showAll()
    {

        $partner = Partner::with('places')->findOrFail(auth()->user()->partner->id);

        $placeIds = $partner->places->pluck('id');

        $bookings = Booking::with(['place'])
            ->whereIn('place_id', $placeIds)
            ->get();

        return $bookings;
    }

    public function cancel(Booking $booking)
    {
        if ($booking->status !== 'complete') {
            $booking->status = 'canceled';
            $booking->save();

            return redirect()->back()->with('success', 'Booking canceled successfully.');
        }

        return redirect()->back()->with('error', 'Completed booking cannot be canceled.');
    }
}
