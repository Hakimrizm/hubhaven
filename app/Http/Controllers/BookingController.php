<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Place;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function showBooking(Place $place)
    {
        $bookings = Booking::with(['user', 'place'])
            ->where('place_id', $place->id)
            ->whereIn('status', ['confirmed', 'complete'])
            ->get();

        $events = $bookings->map(function ($booking) {
            return [
                'title' => 'Sudah Dibooking',
                'start' => $booking->booking_start_time,
                'end'   => $booking->booking_end_time,
                'color' => '#e74c3c',
                'display' => 'background'
            ];
        });

        return response()->json($events);
    }


    public function store(Request $request)
    {
        $request->validate([
            'place_id' => 'required|exists:places,id',
            'booking_start_time' => 'required|date',
            'booking_end_time' => 'required|date|after:booking_start_time',
        ]);

        // Cek ketersediaan
        $conflictingBookings = Booking::where('place_id', $request->place_id)
            ->where(function($query) use ($request) {
                $query->whereBetween('booking_start_time', [$request->booking_start_time, $request->booking_end_time])
                      ->orWhereBetween('booking_end_time', [$request->booking_start_time, $request->booking_end_time])
                      ->orWhere(function($query) use ($request) {
                          $query->where('booking_start_time', '<', $request->booking_start_time)
                                ->where('booking_end_time', '>', $request->booking_end_time);
                      });
            })
            ->whereIn('status', ['confirmed'])
            ->count();

        if ($conflictingBookings > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Waktu yang dipilih sudah dibooking oleh orang lain'
            ]);
        }

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'place_id' => $request->place_id,
            'booking_start_time' => $request->booking_start_time,
            'booking_end_time' => $request->booking_end_time,
            'status' => 'confirmed',
            'notes' => $request->notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibuat',
            'booking' => $booking
        ]);
    }
}
