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
        $place->load([
            'comments.user',
            'reviews',
        ]);

        $comments = $place->comments;

        return view('placeDetail', compact('place', 'comments'));
    }

    public function places(Request $request)
    {
        $query = Place::query();
        if ($request->has('search') && $request->search != '') {
            $query->where('place_name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category') && $request->category != '') {
            $query->where('place_type', $request->category);
        }
        $places = $query->get();
        return view('places', compact('places'));
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
