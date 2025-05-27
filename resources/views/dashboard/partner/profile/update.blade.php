@extends('layouts.dashboard.layout')

@section('header')
<div class="row">
  <div class="col-sm-6"><h3 class="mb-0">Update Profile</h3></div>
</div>
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">
    <form action="{{ route('profile.update', ['profile' => auth()->user()->partner->id]) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="ppartner-bussiness-name" class="form-label required">Company Name</label>
        <input required type="text" class="form-control @error('partner_bussiness_name') is-invalid @enderror" id="ppartner-bussiness-name" placeholder="Company LTD." name="partner_bussiness_name" value="{{ old('partner_bussiness_name', $profile->partner_bussiness_name ?? '') }}">
        @error('partner_bussiness_name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="mb-3">
        <label for="partner-address" class="form-label required">Address</label>
        <input required type="text" class="form-control @error('partner_address') is-invalid @enderror" id="partner-address" placeholder="JL.Soekarno Hatta" name="partner_address" value="{{ old('partner_address', $profile->partner_address ?? '') }}">
        @error('partner_address')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label required" for="phone-number">Phone Number</label>
        <input id="phone-number" required type="text" class="form-control @error('partner_phone') is-invalid @enderror" placeholder="0812" name="partner_phone" value="{{ old('partner_phone', $profile->partner_phone ?? '') }}">
        @error('partner_phone')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label" for="location-link">Location Link</label>
        <input id="location-number" type="text" class="form-control @error('partner_location_url') is-invalid @enderror" placeholder="https://maps.app.goo.gl/" name="partner_location_url" value="{{ old('partner_location_url', $profile->partner_location_url ?? '') }}">
        @error('partner_location_url')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="description" class="form-label required">Description</label>
        <textarea class="form-control @error('partner_description') is-invalid @enderror" id="description" rows="3" name="partner_description">{{ old('partner_description', $profile->partner_description ?? '') }}</textarea>
        @error('partner_description')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button class="btn btn-info" type="submit">Edit Profile</button>
      <a class="btn btn-danger" href="{{ route('profile.show', ['profile' => auth()->user()->partner->id]) }}">Cancel</a>
    </form>
  </div>
</div>
@endsection