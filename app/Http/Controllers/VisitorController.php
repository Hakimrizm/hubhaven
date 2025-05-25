<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Place;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function welcome()
    {
        return view('welcome', [
            'places' => Place::latest()->take(6)->get()
        ]);
    }

    public function placeShow(Place $place)
    {
        $bookings = Booking::with(['user', 'place'])->get();

        $events = $bookings->map(function ($booking) {
            return [
                'title' => $booking->place->place_name . ' - ' . $booking->user->name,
                'start' => $booking->booking_start_time,
                'end' => $booking->booking_end_time,
                'color' => $this->statusColor($booking->status),
            ];
        });

        return view('placeDetail', [
            'bookings' => $events,
            'place' => $place
        ]);
    }

    private function statusColor($status)
    {
        return match($status) {
            'confirmed' => 'green',
            'pending' => 'orange',
            'canceled' => 'red',
            'complete' => 'blue',
            default => 'gray',
        };
    }
}
