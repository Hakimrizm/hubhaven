@extends('layouts.home.layout')

@section('content')
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-4">
      <h3 class="text-center">Welcome <span class="text-info">User!</span></h3>
      <div class="mt-5">
        <form action="{{ route('register') }}" method="POST">
          @csrf
          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="floatingInput" placeholder="John Doe" value="{{ old('name') }}" name="name">
            <label for="floatingInput">Name</label>
						@error('name')
							<span class="text-danger">{{ $message }}</span>
						@enderror
          </div>

          <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" name="email">
            <label for="floatingInput">Email address</label>
						@error('email')
							<span class="text-danger">{{ $message }}</span>
						@enderror
          </div>

          <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" name="password">
            <label for="floatingPassword">Password</label>
						@error('password')
							<span class="text-danger">{{ $message }}</span>
						@enderror
          </div>

          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password_confirmation">
            <label for="floatingPassword">Password Confirmation</label>
          </div>

          <button type="submit" class="btn btn-outline-info w-100">Register</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
