@extends('layouts.home.layout')

@section('content')
<div class="container py-5">
  @if ($place->imagePlaces->count() > 0)
    <div class="row g-2 gallery-container mb-5" style="height: 500px;">
      @if ($place->imagePlaces->count() > 0)
        <div class="col-md-6 h-100">
          <div class="img-wrapper h-100">
            <img
              src="{{ asset('storage/' . $place->imagePlaces[0]->image_place_url) }}"
              alt=""
              class="gallery-img"
              data-bs-toggle="modal"
              data-bs-target="#imageModal"
              data-image="{{ asset('storage/' . $place->imagePlaces[0]->image_place_url) }}"
            >
          </div>
        </div>
      @endif

      <div class="col-md-6 h-100 d-flex flex-column">
        @for ($i = 1; $i < min(5, $place->imagePlaces->count()); $i += 2)
          <div class="row g-2 h-50">
            @for ($j = 0; $j < 2; $j++)
              @php $index = $i + $j; @endphp
              @if (isset($place->imagePlaces[$index]))
                <div class="col-6">
                  <div class="img-wrapper h-100 position-relative">
                    <img
                      src="{{ asset('storage/' . $place->imagePlaces[$index]->image_place_url) }}"
                      alt=""
                      class="gallery-img"
                      data-bs-toggle="modal"
                      data-bs-target="#imageModal"
                      data-image="{{ asset('storage/' . $place->imagePlaces[$index]->image_place_url) }}"
                    >
                    @if ($index === 4 && $place->imagePlaces->count() > 5)
                      <div class="overlay">Lihat semua foto</div>
                    @endif
                  </div>
                </div>
              @endif
            @endfor
          </div>
        @endfor
      </div>
    </div>
  @else
    <div class="col-12 d-flex align-items-center justify-content-center" style="height: 100%;">
      <p class="text-muted fs-5">This place doesn't have image yet.</p>
    </div>
  @endif

  <div class="card mb-3">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="mb-3">
            <div class="mb-0 d-flex align-items-center gap-2">
              <h2>{{ $place->place_name }}</h2>
    
              <div class="d-flex">
                <span class="h5"><i class="bi bi-star-fill text-warning"></i> 4/<span class="text-muted h6">5 (400 Review)</span></span>
              </div>
            </div>
            <span>By <a href="">{{ $place->partner->partner_bussiness_name }}</a></span>
          </div>
    
          <div class="text-muted mb-2">
            <span class="d-block"><i class="bi bi-clock-fill"></i> Open time: {{ \Carbon\Carbon::parse($place->place_open_time)->format('H:i') }} WIB</span>
            <span class="d-block"><i class="bi bi-clock"></i> Closed Time: {{ \Carbon\Carbon::parse($place->place_close_time)->format('H:i') }} WIB</span>
          </div>
          <a target="_blank" href="{{ ($place->place_location_url) ? $place->place_location_url : '#' }}" class="text-muted {{ ($place->place_location_url) ? '' : 'text-decoration-none' }}"><i class="bi bi-geo-alt-fill"></i> {{ $place->place_address }}</a>
        </div>
        <div class="col-md-6 text-end">
          <h3 class="text-info mb-2">{{ 'Rp. ' . number_format($place->place_price_per_hour, 0, ',', '.') }}</h3>
          <span class="text-muted d-block">Per Hour</span>
          @include('components.categoryBadge', ['category' => $place->place_type])
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <h4>Description</h4>
        </div>
        <div class="col-md-12">
          <p>{{ $place->place_description }}</p>
        </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <h4>Review</h4>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
          <h4>
            @php
              $averageRating = $place->averageRating();
              $totalReviews = $place->reviews->count();
            @endphp
            <span class="h4 me-2">
              <i class="bi bi-star-fill text-warning"></i> {{ $averageRating }} /
              <span class="text-muted h6">5 ({{ $totalReviews }} Review{{ $totalReviews !== 1 ? 's' : '' }})</span>
            </span>
          </h4>
        </div>
      </div>

      @foreach ($comments as $comment)
        @php
          $rating = $place->reviews->firstWhere('user_id', $comment->user_id)?->review_rating ?? 0;
        @endphp

        <div class="row mb-4">
          <div class="col-md-12">
            <div class="d-flex gap-3 align-items-start">
              <div class="rounded-circle overflow-hidden border" style="width: 50px; height: 50px;">
                <img src="{{ asset('images/profile/default.png') }}" alt="user" width="100%" height="100%" style="object-fit: cover;">
              </div>
              <div>
                <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>
                <div>
                  @for ($i = 1; $i <= 5; $i++)
                    <span style="color: {{ $i <= $rating ? 'gold' : '#ccc' }}; font-size: 1.2rem;">&#9733;</span>
                  @endfor
                </div>
                <p class="mb-0 text-muted">{{ $comment->comment_content }}</p>
              </div>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>

  <div class="row mt-3">
    @auth
      <div class="col-md-12 d-flex justify-content-end mb-3">
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#book">Book Now!</button>
      </div>
    @endauth
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <div id="calendar" data-place-id="{{ $place->id }}"></div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Modal Image --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0">
        <img src="" id="modalImage" class="img-fluid w-100 rounded" alt="Preview">
      </div>
    </div>
  </div>
</div>

<!-- Modal Booking -->
<div class="modal fade" id="book" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Booking</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="hidden" name="place_id" value="{{ $place->id }}">
        <div class="modal-body">
          <div class="mb-3">
            <label for="start" class="form-label">Date</label>
            <input type="date" class="form-control" id="start" name="date">
          </div>
          <div class="mb-3">
            <label for="start" class="form-label">Start Time</label>
            <input type="time" class="form-control" id="start" name="start_time">
          </div>
          <div class="mb-3">
            <label for="end" class="form-label">End Time</label>
            <input type="time" class="form-control" id="end" name="end_time">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');

    modal.addEventListener('show.bs.modal', function (event) {
      const trigger = event.relatedTarget;
      const imageUrl = trigger.getAttribute('data-image');
      modalImage.src = imageUrl;
    });
  });
</script>
@endsection