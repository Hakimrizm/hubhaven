@extends('layouts.home.layout')

@section('content')
<div class="container py-5">
  <div class="row mb-2">
    <div class="col-md-12">
      <h2>Recent Places</h2>
    </div>
  </div>
  <div class="row justify-content-center">
    @foreach ($places as $place)
    <div class="col-md-4 mb-3">
      <div class="card overflow-hidden h-100">
        <div style="height: 200px;" class="overflow-hidden">
          <img src={{ asset('testingimg.jpg') }} alt="" width="100%">
        </div>
        <div class="card-body">
          <div class="mb-2 d-flex justify-content-between align-items-center">
            @include('components.categoryBadge', ['category' => $place->place_type])
            <span>⭐4/5 <span class="text-muted">(100 Visitor)</span></span>
          </div>
          <h4>{{ 'Rp. ' . number_format($place->place_price_per_hour, 0, ',', '.') }}/Hour</h4>
          <h5 class="text-capitalize">{{ $place->place_name }}</h5>
          @if ($place->place_location_url)
            <a href="{{ $place->place_location_url }}" target="_blank" class="d-block mb-3 text-decoration-none text-primary">
              <i class="bi bi-geo-alt-fill"></i> See Maps
            </a>
          @else
            <span class="d-block mb-3 text-muted" style="cursor: not-allowed;">
              <i class="bi bi-geo-alt-fill"></i> See Maps (Unavailable)
            </span>
          @endif
          <div class="d-flex">
            <button class="btn btn-info w-50">
              <i class="bi-book-half"></i>
              <span class="ms-1">
                Book Now
              </span>
            </button>
            <button type="button" class="btn btn-outline-info w-50 ms-2">
              <i class="bi bi-eye-fill"></i>
              <span class="ms-1">
                Show Details
              </span>
            </button>
          </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-2 text-center">
    <a href="/places" class="text-info">More Places</a>
  </div>
</div>


@endsection