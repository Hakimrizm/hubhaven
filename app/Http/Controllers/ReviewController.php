<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Booking;
use App\Models\Comment;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Booking $booking)
    {
        if ($booking->user_id !== auth()->user()->id || $booking->status !== 'complete') {
            return redirect()->back()->with('error', 'Unauthorized or booking not complete.');
        }

        return view('review', compact('booking'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'review_rating' => 'required|integer|min:1|max:5',
            'comment_content' => 'required|string|max:1000',
        ]);

        $alreadyReviewed = Review::where('user_id', auth()->user()->id)
            ->where('place_id', $booking->place_id)
            ->exists();

        if ($alreadyReviewed) {
            return redirect()->route('review.form', $booking->id)->with('error', 'You have already reviewed this place.');
        }

        Review::create([
            'user_id' => auth()->user()->id,
            'place_id' => $booking->place_id,
            'review_rating' => $request->review_rating,
        ]);

        Comment::create([
            'user_id' => auth()->user()->id,
            'place_id' => $booking->place_id,
            'comment_content' => $request->comment_content,
        ]);

        return redirect("place/$booking->place_id")->with('success', 'Review submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
