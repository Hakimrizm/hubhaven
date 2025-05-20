@extends('layouts.dashboard.layout')

@section('header')
<div class="row">
  <div class="col-sm-6"><h3 class="mb-0">Place Detail</h3></div>
</div>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12 d-flex justify-content-between">
    <div>
      <h4 class="m-0">{{ $place->place_name }}</h4>
      <span class="badge bg-info">{{ $place->place_type }}</span>
    </div>
    <div>
      <a href="/dashboard/place/{{ $place->id }}/edit" class="btn btn-info btn-sm">
        <i class="bi bi-pencil-fill"></i>
      </a>
      <form action="/dashboard/place/{{ $place->id }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this place?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">
          <i class="bi bi-trash3-fill"></i>
        </button>
      </form>
    </div>
  </div>
</div>

<div class="row mt-2">
@foreach ($place->imagePlace as $image)
  <div class="col-md-4">
    <img src="{{ asset('storage/' . $image->image_place_url) }}" alt="" width="100%">
  </div>
@endforeach
</div>

<div class="table-responsive mt-2">
  <table class="table align-middle">
    <tbody>
      <tr>
        <th style="width: 200px;">Price/Hour</th>
        <td>{{ 'Rp. ' . number_format($place->place_price_per_hour, 0, ',', '.') }}</td>
      </tr>
      <tr>
        <th>Open Time</th>
        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $place->place_open_time)->format('H:i') }} WIB</td>
      </tr>
      <tr>
        <th>Close Time</th>
        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $place->place_close_time)->format('H:i') }} WIB</td>
      </tr>
      <tr>
        <th>Address</th>
        <td>{{ $place->place_address }}</td>
      </tr>
      <tr>
        <th>Link Location</th>
        <td>
          @if ($place->place_location_url)
            <a href="{{ $place->place_location_url }}" target="_blank">{{ $place->place_location_url }}</a>
          @else
            <em class="text-muted">Location not added yet :(</em>
          @endif
        </td>
      </tr>
    </tbody>
  </table>
</div>


<div class="row mt-2">
  <div class="col-md-12">
    <h5>Description</h5>
  </div>

  <div class="row">
    <div class="col-md-12">
      <p>{{ $place->place_description }}</p>
    </div>
  </div>
</div>

<div class="row mt-2">
  <div class="col-md-6 text-center">
    <div class="border py-4 rounded mb-2 shadow-sm">
      <h5 class="fw-semibold mb-1">12</h5>
      <span>Total Visited</span>
    </div>
  </div>
  <div class="col-md-6 text-center">
    <div class="border py-4 rounded mb-2 shadow-sm">
      <h5 class="fw-semibold mb-1">1.200.000</h5>
      <span>Total Income</span>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <a href="/dashboard/place" class="text-info"><< Back</a>
  </div>
</div>

@endsection