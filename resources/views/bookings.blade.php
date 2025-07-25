@extends('layouts.home.layout')

@section('content')

@php
  use Carbon\Carbon;
@endphp

<div class="container mt-3">
  <h1>My Bookings</h1>

  <div class="card">
    <div class="card-body">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Place Name</th>
            <th scope="col">Start Time</th>
            <th scope="col">End Time</th>
            <th scope="col">Total</th>
            <th scope="col">Price/Hour</th>
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
              <td>{{ Carbon::parse($booking->booking_start_time)->format('H:i') }}</td>
              <td>{{ Carbon::parse($booking->booking_end_time)->format('H:i') }}</td>
              <td>{{ 'Rp. ' . number_format($booking->booking_total, 0, ',', '.') }}</td>
              <td>{{ 'Rp. ' . number_format($booking->place->place_price_per_hour, 0, ',', '.') }}</td>
              <td>{{ Carbon::parse($booking->booking_start_time)->format('Y-m-d') }}</td>
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
              {{-- <td>{{ $booking->book_total }}</td> --}}
              <td>
                @if ($booking->status === 'complete')
                  <a href="{{ route('review.form', $booking->id) }}" class="btn btn-success btn-sm">Review</a>
                @else
                  <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                    @csrf
                    @method('PUT')
                    <button class="btn btn-danger btn-sm">Cancel</button>
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