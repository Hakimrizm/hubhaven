@extends('layouts.home.layout')

@section('content')
<div class="container py-5">
  <div class="row g-2 gallery-container mb-5" style="height: 500px;">
    @if ($place->imagePlaces->count() > 0)
      <div class="col-md-6 h-100">
        <div class="img-wrapper h-100">
          <img
            src="{{ asset('storage/' . $place->imagePlaces[0]->image_place_url) }}"
            alt=""
            class="gallery-img"
            data-bs-toggle="modal"
            data-bs-target="#imageModal"
            data-image="{{ asset('storage/' . $place->imagePlaces[0]->image_place_url) }}"
          >
        </div>
      </div>
    @endif

    <div class="col-md-6 h-100 d-flex flex-column">
      @for ($i = 1; $i < min(5, $place->imagePlaces->count()); $i += 2)
        <div class="row g-2 h-50">
          @for ($j = 0; $j < 2; $j++)
            @php $index = $i + $j; @endphp
            @if (isset($place->imagePlaces[$index]))
              <div class="col-6">
                <div class="img-wrapper h-100 position-relative">
                  <img
                    src="{{ asset('storage/' . $place->imagePlaces[$index]->image_place_url) }}"
                    alt=""
                    class="gallery-img"
                    data-bs-toggle="modal"
                    data-bs-target="#imageModal"
                    data-image="{{ asset('storage/' . $place->imagePlaces[$index]->image_place_url) }}"
                  >
                  @if ($index === 4 && $place->imagePlaces->count() > 5)
                    <div class="overlay">Lihat semua foto</div>
                  @endif
                </div>
              </div>
            @endif
          @endfor
        </div>
      @endfor
    </div>
  </div>

  <div class="row mb-5">
    <div class="col-md-6">
      <h2 class="mb-2">{{ $place->place_name }}</h2>
      <div class="d-flex">
        <span class="h5"><i class="bi bi-star-fill text-warning"></i> 4/<span class="text-muted h6">5 (400 Review)</span></span>
      </div>
      <div class="text-muted mb-2">
        <span class="d-block"><i class="bi bi-clock-fill"></i> Open time: {{ \Carbon\Carbon::createFromFormat('H:i:s', $place->place_open_time)->format('H:i') }} WIB</span>
        <span class="d-block"><i class="bi bi-clock"></i> Closed Time: {{ \Carbon\Carbon::createFromFormat('H:i:s', $place->place_close_time)->format('H:i') }}</span>
      </div>
      <a target="_blank" href="{{ ($place->place_location_url) ? $place->place_location_url : '#' }}" class="text-muted {{ ($place->place_location_url) ? '' : 'text-decoration-none' }}"><i class="bi bi-geo-alt-fill"></i> {{ $place->place_address }}</a>
    </div>
    <div class="col-md-6 text-end">
      <h3 class="text-info mb-2">{{ 'Rp. ' . number_format($place->place_price_per_hour, 0, ',', '.') }}</h3>
      <span class="text-muted d-block">Per Hour</span>
      @include('components.categoryBadge', ['category' => $place->place_type])
    </div>
  </div>

  <div class="row mb-5">
    <div class="col-md-12">
      <h4>Description</h4>
    </div>
    <div class="col-md-12">
      <p>{{ $place->place_description }}</p>
    </div>
  </div>

  <div class="row mb-3">
    <div class="col-md-6">
      <h4>Review</h4>
    </div>
    <div class="col-md-6 d-flex justify-content-end align-items-center">
      <h4>
        <span class="h4 me-2">
          <i class="bi bi-star-fill text-warning"></i> 4/
          <span class="text-muted h6">5 (400 Review)</span>
        </span>
      </h4>
      <button class="btn btn-sm btn-outline-info me-2" data-bs-target="#reviewCarousel" data-bs-slide="prev"><</button>
      <button class="btn btn-sm btn-outline-info" data-bs-target="#reviewCarousel" data-bs-slide="next">></button>
    </div>
  </div>

  <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

      <!-- Slide 1 -->
      <div class="carousel-item active">
        <div class="row">
          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                  <span>4/5</span>
                  <span class="text-muted">1 Day Ago</span>
                </div>
                <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore provident quia nisi."</p>
                <h6><em>Samual Bernadni</em></h6>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                  <span>4/5</span>
                  <span class="text-muted">1 Day Ago</span>
                </div>
                <p>"Lorem ipsum dolor sit amet consectetur."</p>
                <h6><em>Samual Bernadni</em></h6>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                  <span>4/5</span>
                  <span class="text-muted">1 Day Ago</span>
                </div>
                <p>"Lorem ipsum dolor sit amet consectetur adipisicing elit."</p>
                <h6><em>Samual Bernadni</em></h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <div class="row">
          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                  <span>5/5</span>
                  <span class="text-muted">2 Days Ago</span>
                </div>
                <p>"Another review comment here."</p>
                <h6><em>Jane Doe</em></h6>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                  <span>3/5</span>
                  <span class="text-muted">3 Days Ago</span>
                </div>
                <p>"Could be better."</p>
                <h6><em>John Smith</em></h6>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                  <span>4/5</span>
                  <span class="text-muted">3 Days Ago</span>
                </div>
                <p>"Pretty good overall!"</p>
                <h6><em>Alice Johnson</em></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div id="calendar" data-place-id="{{ $place->id }}"></div>
    </div>
  </div>
</div>

{{-- Modal Image --}}
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0">
        <img src="" id="modalImage" class="img-fluid w-100 rounded" alt="Preview">
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');

    modal.addEventListener('show.bs.modal', function (event) {
      const trigger = event.relatedTarget;
      const imageUrl = trigger.getAttribute('data-image');
      modalImage.src = imageUrl;
    });
  });
</script>
@endsection