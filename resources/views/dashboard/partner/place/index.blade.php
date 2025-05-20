@extends('layouts.dashboard.layout')

@section('header')
<div class="row">
  <div class="col-sm-6"><h3 class="mb-0">My Places</h3></div>
</div>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12 mb-2 d-flex justify-content-end">
    <a href="/dashboard/place/create" class="btn btn-info">Add Place</a>
  </div>
  @if (session('success'))
    <div class="col-md-12">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Whooilah!</strong> {{ session('success') }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  @endif
  <div class="col-md-12">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th style="width: 10px">#</th>
          <th>Place Name</th>
          <th style="width: 40px">Category</th>
          <th style="width: 100px">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($places as $place)
          <tr class="align-middle">
            <td>
              {{ $loop->iteration }}.
            </td>
            <td>
              {{ $place->place_name }}
              @if (session('place_id') == $place->id)
                <span class="badge text-bg-success">{{ session('status') }}</span>
              @endif
            </td>
            <td>
              @include('components.categoryBadge', ['category' => $place->place_type])
            </td>
            <td>
              <a href="/dashboard/place/{{ $place->id }}" class="btn btn-info btn-sm">
                <i class="bi bi-eye-fill"></i>
              </a>
              <a href="/dashboard/place/{{ $place->id }}/edit" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil-fill"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection