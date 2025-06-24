@extends('layouts.home.layout')

@section('content')
<div class="container" style="height: 300px;">
  <div class="rounded border mt-3 d-flex flex-column justify-content-center align-items-center text-white text-center" style="height: 100%; background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('{{ asset('images/bg-hero.jpg') }}') center/cover no-repeat">
    <h1 style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Book the Perfect Space for Any Occasion</h1>
    <p style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Meeting rooms, music studios, dance spaces, or sports fields — all in one place, ready when you are.</p>
  </div>
</div>

<div class="container mt-3">
  <div class="row">
    <div class="col-md-3 d-flex flex-wrap h-auto">
      <div class="w-100 w-md-auto" style="height: 150px;">
        <div class="rounded border d-flex flex-column justify-content-center align-items-center text-white text-center" style="height: 100%; background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('{{ asset('images/studio-bg.jpg') }}') center/cover no-repeat">
          <h3 style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Studio</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 d-flex flex-wrap h-auto">
      <div class="w-100 w-md-auto" style="height: 150px;">
        <div class="rounded border d-flex flex-column justify-content-center align-items-center text-white text-center" style="height: 100%; background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('{{ asset('images/field-bg.jpg') }}') center/cover no-repeat">
          <h3 style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Field</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 d-flex flex-wrap h-auto">
      <div class="w-100 w-md-auto" style="height: 150px;">
        <div class="rounded border d-flex flex-column justify-content-center align-items-center text-white text-center" style="height: 100%; background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('{{ asset('images/co-working-bg.jpg') }}') center/cover no-repeat">
          <h3 style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Co-Working</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 d-flex flex-wrap h-auto">
      <div class="w-100 w-md-auto" style="height: 150px;">
        <div class="rounded border d-flex flex-column justify-content-center align-items-center text-white text-center" style="height: 100%; background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('{{ asset('images/meeting-bg.jpg') }}') center/cover no-repeat">
          <h3 style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Meeting</h3>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container py-5">
  <div class="row mb-2">
    <div class="col-md-12">
      <h2>Popular Places</h2>
    </div>
  </div>

  <div class="row">
    @forelse ($places as $place)
      <div class="col-md-4 mb-3">
        <div class="card overflow-hidden h-100">
          <div style="height: 200px;" class="overflow-hidden">
            <img src={{ asset('testingimg.jpg') }} alt="" width="100%">
          </div>
          <div class="card-body">
            <div class="mb-2 d-flex justify-content-between align-items-center">
              @include('components.categoryBadge', ['category' => $place->place_type])
              <span><i class="bi bi-star-fill text-warning"></i>4/5 <span class="text-muted">(100 Visitor)</span></span>
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

            <a href="/place/{{ $place->id }}" class="btn btn-outline-info w-100">
              <i class="bi-book-half"></i>
              <span class="ms-1">
                See Schedule
              </span>
            </a>
          </div>
        </div>
      </div>
    @empty 
      <div class="col-12 d-flex align-items-center justify-content-center" style="height: 100%;">
        <p class="text-muted fs-5">Not places has been added</p>
      </div>
    @endforelse
  </div>

  <div class="mt-2 text-center">
    <a href="/places" class="text- info">More Places</a>
  </div>
</div>

@endsection