@extends('layouts.home.layout')

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="rounded-circle border mx-auto overflow-hidden" style="height: 100px; width: 100px">
              <img src="{{ asset('images/profile/default.png') }}" alt="" width="100%">
            </div>

            <div class="text-center mt-2">
              <h1>{{ $user->name }}</h1>
              <h3 class="text-muted">{{ $user->email }}</h3>

              <a href="{{ route('userProfile.edit', $user->id) }}" class="btn btn-info mt-3">Edit Profile</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection