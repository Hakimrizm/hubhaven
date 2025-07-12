<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $partner = $user->partner;

        if (!$partner) {
            return redirect()->route('partner.register')->with('error', 'Anda belum terdaftar sebagai partner.');
        }

        $places = $partner->places;

        // Data visualisasi
        $placeCount = $places->count();
        $bookingCount = \App\Models\Booking::whereIn('place_id', $places->pluck('id'))->count();
        $bookingStatus = \App\Models\Booking::whereIn('place_id', $places->pluck('id'))
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $averageRating = \App\Models\Review::whereIn('place_id', $places->pluck('id'))->avg('review_rating');

        $latestComments = \App\Models\Comment::whereIn('place_id', $places->pluck('id'))
            ->with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'placeCount',
            'bookingCount',
            'bookingStatus',
            'averageRating',
            'latestComments'
        ));
    }
}
