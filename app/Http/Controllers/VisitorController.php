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
        // Eager load comments beserta user dan reviews dari user tsb
        $place->load([
            'comments.user',
            'reviews', // Untuk review rating per user
        ]);

        $comments = $place->comments;

        return view('placeDetail', compact('place', 'comments'));
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
