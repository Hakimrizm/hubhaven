@extends('layouts.home.layout')

@section('content')

<div class="container mt-3">
  <div class="col-md-12">
    <form action="" style="width: 100%" class="d-flex justify-content-center">
      <select name="category" id="" class="form-select w-25 me-2">
        <option value="" {{ (request('category') == '') ? 'selected' : '' }}>All</option>
        <option value="studio" {{ (request('category') == 'studio') ? 'selected' : '' }}>Studio</option>
        <option value="co_working" {{ (request('category') == 'co_working') ? 'selected' : '' }}>Co-Working</option>
        <option value="meeting_room" {{ (request('category') == 'meeting_room') ? 'selected' : '' }}>Meeting Room</option>
        <option value="field" {{ (request('category') == 'field') ? 'selected' : '' }}>Field</option>
        <option value="etc" {{ (request('category') == 'etc') ? 'selected' : '' }}>Etc</option>
      </select>
      <input type="text" class="form-control w-50" name="search" placeholder="Search" value="{{ request('search') }}">
      <button type="submit" class="btn btn-dark">Search</button>
    </form>
  </div>
</div>

<div class="container mt-3">
  <div class="row mb-2">
    <div class="col-md-12">
      <h2>All Places</h2>
    </div>
  </div>

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

@endsection