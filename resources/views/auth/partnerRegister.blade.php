@extends('layouts.home.layout')

@section('content')
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form id="partner-registration-form" action="{{ route('register.partner') }}" method="POST" novalidate>
        @csrf {{-- STEP 1 --}}
        <div id="step-1">
          <h3 class="text-center">Step 1: Account Info</h3>

          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="John Doe" value="{{ old('name') }}" />
            <label>Name</label>
            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="email@example.com" value="{{ old('email') }}" />
            <label>Email</label>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" />
            <label>Password</label>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" />
            <label>Confirm Password</label>
          </div>

          <button type="button" id="next-step" class="btn btn-info w-100">Next</button>
        </div>

        {{-- STEP 2 --}}
        <div id="step-2" style="display: none;">
          <h3 class="text-center">Step 2: Partner Info</h3>

          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('partner_bussiness_name') is-invalid @enderror" name="partner_bussiness_name" placeholder="Business Name" value="{{ old('partner_bussiness_name') }}" />
            <label>Business Name</label>
            @error('partner_bussiness_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-floating mb-3">
            <textarea class="form-control @error('partner_address') is-invalid @enderror" name="partner_address" placeholder="Address" style="height: 80px;">{{ old('partner_address') }}</textarea>
            <label>Address</label>
            @error('partner_address')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control @error('partner_phone') is-invalid @enderror" name="partner_phone" placeholder="Phone Number" value="{{ old('partner_phone') }}" />
            <label>Phone Number</label>
            @error('partner_phone')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-floating mb-3">
            <input type="url" class="form-control @error('partner_location_url') is-invalid @enderror" name="partner_location_url" placeholder="Google Maps URL" value="{{ old('partner_location_url') }}" />
            <label>Place Location URL</label>
            @error('partner_location_url')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-floating mb-3">
            <textarea class="form-control @error('partner_description') is-invalid @enderror" name="partner_description" placeholder="Description" style="height: 100px;">{{ old('partner_description') }}</textarea>
            <label>Description</label>
            @error('partner_description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex justify-content-between">
            <button type="button" id="back-step" class="btn btn-secondary">Back</button>
            <button type="submit" class="btn btn-success">Register</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  const step1 = document.getElementById('step-1');
  const step2 = document.getElementById('step-2');
  const nextBtn = document.getElementById('next-step');
  const backBtn = document.getElementById('back-step');

  nextBtn.addEventListener('click', () => {
    step1.style.display = 'none';
    step2.style.display = 'block';
  });

  backBtn.addEventListener('click', () => {
    step2.style.display = 'none';
    step1.style.display = 'block';
  });

  @if($errors->has('partner_bussiness_name') || $errors->has('partner_address') || $errors->has('partner_phone') || $errors->has('partner_location_url') || $errors->has('partner_description'))
    step1.style.display = 'none';
    step2.style.display = 'block';
  @endif
</script>


@endsection