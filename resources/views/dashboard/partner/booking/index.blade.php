@extends('layouts.dashboard.layout')

@section('header')

@php
  use Carbon\Carbon;
@endphp

<div class="row">
  <div class="col-sm-6"><h3 class="mb-0">Bookings</h3></div>
</div>
@endsection

@section('content')
<div class="row">
  @if (session('success'))
    <div class="col-md-12">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Whooilah!</strong> {{ session('success') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endif

  <div class="card">
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Place Name</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Start Time</th>
            <th scope="col">End Time</th>
            <th scope="col">date</th>
            <th scope="col">status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($bookings as $booking)
            <tr>
              <th scope="row">{{ $loop->iteration }}</th>
              <td>{{ $booking->place->place_name }}</td>
              <td>{{ $booking->user->name }}</td>
              <td>{{ Carbon::parse($booking->booking_start_time)->format('H:i') }}</td>
              <td>{{ Carbon::parse($booking->booking_end_time)->format('H:i') }}</td>
              <td>{{ \Carbon\Carbon::parse($booking->booking_start_time)->format('Y-m-d') }}</td>
              <td>
                <span class="badge 
                  {{ $booking->status === 'pending' ? 'bg-warning text-dark' : '' }}
                  {{ $booking->status === 'canceled' ? 'bg-danger' : '' }}
                  {{ $booking->status === 'confirmed' ? 'bg-primary' : '' }}
                  {{ $booking->status === 'complete' ? 'bg-success' : '' }}
                  ">
                  {{ ucfirst($booking->status) }}
                </span>
              </td>
              <td class="d-flex gap-1">
                @if ($booking->status === 'pending')
                  <form action="{{ route('booking.confirm', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-sm btn-primary">Confirm</button>
                  </form>
                  <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Cancel this booking?')">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-sm btn-danger">Cancel</button>
                  </form>
                @elseif ($booking->status === 'confirmed')
                  <form action="{{ route('booking.complete', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-sm btn-success">Complete</button>
                  </form>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection