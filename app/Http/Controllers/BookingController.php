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

        // Cek konflik waktu booking
        $conflict = Booking::where('place_id', $request->place_id)
            ->where(function ($query) use ($bookingStart, $bookingEnd) {
                $query->whereBetween('booking_start_time', [$bookingStart, $bookingEnd])
                    ->orWhereBetween('booking_end_time', [$bookingStart, $bookingEnd])
                    ->orWhere(function ($query) use ($bookingStart, $bookingEnd) {
                        $query->where('booking_start_time', '<=', $bookingStart)
                            ->where('booking_end_time', '>=', $bookingEnd);
                    });
            })
            ->whereIn('status', ['pending', 'confirmed'])
            ->exists();

        if ($conflict) {
            return back()->withErrors(['error' => 'This time has been booked.']);
        }

        $place = Place::findOrFail($request->place_id);
        $duration = $bookingEnd->floatDiffInHours($bookingStart);
        $bookingTotal = $duration * $place->place_price_per_hour;

        Booking::create([
            'user_id' => auth()->user()->id,
            'place_id' => $request->place_id,
            'booking_start_time' => $bookingStart,
            'booking_end_time' => $bookingEnd,
            'booking_total' => $bookingTotal,
            'status' => 'pending',
        ]);

        return redirect('/myBookings')->with('success', 'Booking successfully added');
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

        return view('dashboard.partner.booking.index', compact('bookings'));
    }

    public function confirm(Booking $booking)
    {
        if ($booking->status === 'pending') {
            $booking->status = 'confirmed';
            $booking->save();
            return redirect()->back()->with('success', 'Booking confirmed successfully.');
        }
        return redirect()->back()->with('error', 'Booking cannot be confirmed.');
    }

    public function complete(Booking $booking)
    {
        if ($booking->status === 'confirmed') {
            $booking->status = 'complete';
            $booking->save();

            $place =  $booking->place;
            $place->place_income += $booking->booking_total;
            $place->save();

            return redirect()->back()->with('success', 'Booking marked as complete.');
        }
        return redirect()->back()->with('error', 'Only confirmed bookings can be completed.');
    }

    public function cancel(Booking $booking)
    {
        if ($booking->status !== 'complete') {
            $booking->status = 'canceled';
            $booking->save();

            return redirect()->back()->with('success', 'Booking completed successfully.');
        }

        return redirect()->back()->with('error', 'Completed booking cannot be canceled.');
    }
}
