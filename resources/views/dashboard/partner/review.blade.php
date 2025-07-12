@extends('layouts.dashboard.layout')

@section('header')
<div class="row">
  <div class="col-sm-6"><h3 class="mb-0">Ulasan Pengguna</h3></div>
</div>
@endsection

@section('content')
<div class="container">
  @if ($reviews->count() > 0)
  <div class="table-responsive">
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>User</th>
          <th>Tempat</th>
          <th>Rating</th>
          <th>Tanggal</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($reviews as $review)
          <tr>
            <td>{{ $review->user->name }}</td>
            <td>{{ $review->place->place_name }}</td>
            <td>
              @for ($i = 1; $i <= 5; $i++) @if ($i <= $review->review_rating) ⭐ @else ☆ @endif @endfor
              <span class="ms-2">{{ $review->review_rating }}/5</span>
            </td>
            <td>{{ $review->created_at->format('d M Y, H:i') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
    <div class="alert alert-info">Belum ada review dari pengguna.</div>
  @endif
</div>
@endsection
