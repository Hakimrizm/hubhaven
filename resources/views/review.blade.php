@extends('layouts.home.layout')

@section('content')
<style>
  .star-rating {
    direction: rtl;
    display: inline-flex;
  }

  .star-rating input[type="radio"] {
    display: none;
  }

  .star-rating label {
    font-size: 2rem;
    color: #ddd;
    cursor: pointer;
    transition: color 0.2s;
  }

  .star-rating input[type="radio"]:checked ~ label {
    color: gold;
  }

  .star-rating label:hover,
  .star-rating label:hover ~ label {
    color: gold;
  }
</style>


<div class="container mt-4">
  <h2>Review Booking: {{ $booking->place->place_name }}</h2>

  @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  <div class="card">
    <div class="card-body">
      <form action="{{ route('review.store', $booking->id) }}" method="POST">
        @csrf

        <div class="mb-3">
          <label class="form-label d-block">Rating</label>
          <div class="star-rating">
            @for ($i = 5; $i >= 1; $i--)
              <input type="radio" id="star{{ $i }}" name="review_rating" value="{{ $i }}" required>
              <label for="star{{ $i }}" title="{{ $i }} stars">&#9733;</label>
            @endfor
          </div>
        </div>
    
        <div class="mb-3">
          <label for="comment_content" class="form-label">Your Comment</label>
          <textarea name="comment_content" id="comment_content" rows="4" class="form-control" required></textarea>
        </div>
    
        <button type="submit" class="btn btn-primary">Submit Review</button>
      </form>
    </div>
  </div>

</div>
@endsection
