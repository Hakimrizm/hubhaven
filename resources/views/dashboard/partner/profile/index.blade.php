@extends('layouts.dashboard.layout')

@section('header')
<div class="row">
  <div class="col-sm-6"><h3 class="mb-0">Profile</h3></div>
</div>
@endsection

@section('content')
@if (session('success'))
  <div class="col-md-12">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Whooilah!</strong> {{ session('success') }}.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  </div>
@endif
  <div class="row">
    <div class="col-md-4 mb-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-column align-items-center gap-2 mb-2">
            <div class="img-wrapper rounded-circle overflow-hidden" style="width: 100px; height: 100px;">
              <img src="{{ asset('images/profile/default.png') }}" alt="Profile" class="w-100 h-100 object-fit-cover">
            </div>
            <div class="text-muted text-center">
              <div>
                <i class="bi bi-person-fill"></i> {{ auth()->user()->name }}
              </div>
              <div>
                <i class="bi bi-envelope-fill"></i> {{ auth()->user()->email }}
              </div>
            </div>
          </div>
          <a href="{{ route('userProfile.show', auth()->user()->id) }}" class="btn btn-outline-info w-100">Edit Profile</a>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="card">
        <div class="card-body">
          <div class="mb-3">
            <h5 class="mb-1">Company Name</h5>
            <span class="text-muted">{{ $profile->partner_bussiness_name }}</span>
          </div>
          <div class="mb-3">
            <h5 class="mb-1">Address</h5>
            <span class="text-muted">{{ $profile->partner_address }}</span>
          </div>
          <div class="mb-3">
            <h5 class="mb-1">Location Url</h5>
            <span class="text-muted">
              @if ($profile->partner_location_url)
                <a href="{{ $profile->partner_location_url }}" target="_blank" class="text-muted">{{ $profile->partner_location_url }}</a>
              @else
                <span class="text-muted">-</span>
              @endif
            </span>
          </div>
          <div class="mb-3">
            <h5 class="mb-1">Phone Number</h5>
            <span class="text-muted">{{ $profile->partner_phone }}</span>
          </div>
          <div class="mb-3">
            <h5 class="mb-1">Description</h5>
            <span class="text-muted">{{ $profile->partner_description }}</span>
          </div>

          <a href="{{ route('profile.edit', ['profile' => $profile->id]) }}" class="btn btn-outline-info">Edit Company Profile</a>
        </div>
      </div>
    </div>
  </div>
@endsection