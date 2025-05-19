@extends('layouts.dashboard.layout')

@section('header')
<div class="row">
  <div class="col-sm-6"><h3 class="mb-0">Create Place</h3></div>
</div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <form action="/dashboard/place" method="POST">
        @csrf

        <div class="mb-3">
          <label for="place-title" class="form-label required">Place Name</label>
          <input required type="text" class="form-control @error('place_name') is-invalid @enderror" id="place-title" placeholder="Name" value="{{ old('place_name') }}" name="place_name">
          @error('place_name')
            <span class="text-danger d-inline-block mt-2">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="price" class="form-label required">Price/Hour</label>
          <input required type="number" class="form-control @error('place_price_per_hour') is-invalid @enderror" id="price" placeholder="50000" value="{{ old('place_price_per_hour') }}" name="place_price_per_hour">
          @error('place_price_per_hour')
            <span class="text-danger d-inline-block mt-2">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3 d-flex">
          <div class="me-2">
            <label for="" class="form-label required">Open</label>
            <input required type="time" class="form-control @error('place_open_time') is-invalid @enderror" value="{{ old('place_open_time') }}" name="place_open_time">
          </div>
          <div>
            <label for="" class="form-label required">Close</label>
            <input required type="time" class="form-control @error('place_close_time') is-invalid @enderror" value="{{ old('place_close_time') }}" name="place_close_time">
          </div>
          @error('place_open_time')
            <span class="text-danger d-inline-block mt-2">{{ $message }}</span>
          @enderror
          @error('place_close_time')
            <span class="text-danger d-inline-block mt-2">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="place-title" class="form-label required">Address</label>
          <input required type="text" class="form-control @error('place_address') is-invalid @enderror" id="place-title" placeholder="JL. Soekarno Hatta" value="{{ old('place_address') }}" name="place_address">
          @error('place_address')
            <span class="text-danger d-inline-block mt-2">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="place-title" class="form-label">Location Link</label>
          <input type="text" class="form-control @error('place_location_url') is-invalid @enderror" id="place-title" placeholder="https://...." value="{{ old('place_location_url') }}" name="place_location_url">
          @error('place_location_url')
            <span class="text-danger d-inline-block mt-2">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="type" class="form-label required">Type</label>
          <select required class="form-select @error('place_type') is-invalid @enderror" aria-label="Default select example" id="type" name="place_type">
            <option value="studio" selected>Studio</option>
            <option value="field">Field</option>
            <option value="co_working">Co-Working</option>
            <option value="meeting_room">Meeting Room</option>
            <option value="etc">Etc</option>
          </select>

          @error('place_type')
            <span class="text-danger d-inline-block mt-2">{{ $message }}</span>
          @enderror
        </div>

        <div class="mb-3">
          <label for="description" class="form-label required">Description</label>
          <textarea class="form-control @error('place_description') is-invalid @enderror" id="description" rows="3" name="place_description">{{ old('place_description', $place->place_description ?? '') }}</textarea>

          @error('place_description')
            <span class="text-danger d-inline-block mt-2">{{ $message }}</span>
          @enderror
        </div>

        <button class="btn btn-info" type="submit">Create Place</button>
      </form>
    </div>
  </div>
@endsection
