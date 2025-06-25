@extends('layouts.home.layout')

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <form action="{{ route('userProfile.update', $user->id) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" class="form-control" value="{{ old('name', $user->name) }}" name="name">
              </div>
              <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ old('email', $user->email) }}" name="email">
              </div>

              <button type="submit" class="btn btn-info">Edit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection