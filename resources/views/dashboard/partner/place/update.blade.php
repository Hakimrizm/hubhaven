@extends('layouts.dashboard.layout')

@section('header')
<div class="row">
  <div class="col-sm-6"><h3 class="mb-0">Edit Place</h3></div>
</div>
@endsection

@section('content')
<div class="row">
  <div class="col-md-6">
    <form action="/dashboard/place/{{ $place->id }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label for="place-title" class="form-label required">Place Name</label>
        <input required type="text" class="form-control @error('place_name') is-invalid @enderror" id="place-title" placeholder="Name" name="place_name" value="{{ old('place_name', $place->place_name ?? '') }}">
        @error('place_name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <div id="images-wapper" class="d-flex flex-wrap gap-3">
          @foreach ($place->imagePlaces as $image)
            <div data-id="{{ $image->id }}" style="position: relative;">
              <img src="{{ asset('storage/' . $image->image_place_url) }}" style="width: 100px;">
              <input type="hidden" name="old_image_place[]" value="{{ $image->id }}">
              <button type="button" class="btn btn-sm text-danger btn-delete" style="position: absolute; top: 0; right: 0;">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          @endforeach
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Upload Images</label>
        <div id="image-inputs">
          <div class="image-input-wrapper mb-2">
            <input type="file" name="image_place_url[]" accept="image/*" class="form-control image-input @error('image_place_url') is-invalid @enderror">
            <img class="preview-img mt-2" style="max-width: 150px; display: none;">
          </div>
        </div>
        @error('image_place_url')
          <span class="text-danger d-inline-block mt-2">{{ $message }}</span>
        @enderror
        <button type="button" class="btn btn-secondary mt-2" id="add-image-btn">+ Add Image</button>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label required">Price/Hour</label>
        <input required type="number" class="form-control @error('place_price_per_hour') is-invalid @enderror" id="price" placeholder="50000" name="place_price_per_hour" value="{{ old('place_price_per_hour', $place->place_price_per_hour ?? '') }}">
        @error('place_price_per_hour')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3 d-flex">
        <div class="me-2">
          <label class="form-label required">Open</label>
          <input required type="time" class="form-control @error('place_open_time') is-invalid @enderror" value="{{ substr(old('place_open_time', $place->place_open_time ?? ''), 0, 5) }}" name="place_open_time">
          @error('place_open_time')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div>
          <label class="form-label required">Close</label>
          <input required type="time" class="form-control @error('place_close_time') is-invalid @enderror" value="{{ substr(old('place_close_time', $place->place_open_time ?? ''), 0, 5) }}" name="place_close_time">
          @error('place_close_time')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label required">Address</label>
        <input required type="text" class="form-control @error('place_address') is-invalid @enderror" placeholder="JL. Soekarno Hatta" name="place_address" value="{{ old('place_address', $place->place_address ?? '') }}">
        @error('place_address')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Location Link</label>
        <input type="text" class="form-control @error('place_location_url') is-invalid @enderror" placeholder="https://maps.app.goo.gl/" name="place_location_url" value="{{ old('place_location_url', $place->place_location_url ?? '') }}">
        @error('place_location_url')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="type" class="form-label required">Type</label>
        <select required class="form-select @error('place_type') is-invalid @enderror" id="type" name="place_type">
          @php
            $types = ['studio', 'field', 'co_working', 'meeting_room', 'etc'];
            $selectedType = old('place_type', $place->place_type ?? '');
          @endphp
          @foreach ($types as $type)
            <option value="{{ $type }}" {{ $selectedType === $type ? 'selected' : '' }}>
              {{ ucfirst(str_replace('_', ' ', $type)) }}
            </option>
          @endforeach
        </select>
        @error('place_type')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="description" class="form-label required">Description</label>
        <textarea class="form-control @error('place_description') is-invalid @enderror" id="description" rows="3" name="place_description">{{ old('place_description', $place->place_description ?? '') }}</textarea>
        @error('place_description')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button class="btn btn-info" type="submit">Edit Place</button>
      <a class="btn btn-danger" href="/dashboard/place">Cancel</a>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const container = document.getElementById('image-inputs');
  const addBtn = document.getElementById('add-image-btn');
  const imageWrapper = document.getElementById('images-wapper');

  // Preview handler
  function handlePreview(input) {
    input.addEventListener('change', function (e) {
      const file = this.files[0];
      const preview = this.parentElement.querySelector('.preview-img');
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
      }
    });
  }

  // Initial preview binding
  const firstInput = container.querySelector('.image-input');
  handlePreview(firstInput);

  // Tambah input baru
  addBtn.addEventListener('click', function () {
    const wrapper = document.createElement('div');
    wrapper.classList.add('image-input-wrapper', 'mb-2');
    wrapper.innerHTML = `
      <input type="file" name="image_place_url[]" accept="image/*" class="form-control image-input @error('image_place_url') is-invalid @enderror">
      <img class="preview-img mt-2" style="max-width: 150px; display: none;">
    `;
    container.appendChild(wrapper);
    const newInput = wrapper.querySelector('.image-input');
    handlePreview(newInput);
  });

  imageWrapper.addEventListener('click', async function(e) {
    const btn = e.target.closest('.btn-delete');
    if (!btn) return;

    const parentDiv = btn.closest('[data-id]');
    const imageId = parentDiv.dataset.id;

    if (!imageId) return;
    const cancle = await Swal.fire({
      title: 'Are you sure?',
      text: 'Do you want to delete this image?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel'
    });

    if (cancle.isConfirmed) {
      try {
        const res = await fetch(`/dashboard/place/image/${imageId}`, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
          }
        });
  
        if (!res.ok) {
          const errorData = await res.json();
          console.error('Delete failed:', errorData);
          alert('Gagal menghapus gambar.');
          return;
        }
  
        parentDiv.remove();
      } catch (error) {
        console.error('Network error:', error);
        alert('Terjadi kesalahan jaringan.');
      }
    }

  });

});
</script>  
@endsection