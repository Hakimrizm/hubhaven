@extends('layouts.home.layout')

@section('content')
<div class="container" style="height: 300px;">
  <div class="rounded border mt-3 d-flex flex-column justify-content-center align-items-center text-white text-center" style="height: 100%; background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('{{ asset('images/bg-hero.jpg') }}') center/cover no-repeat">
    <h1 style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Book the Perfect Space for Any Occasion</h1>
    <p style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Meeting rooms, music studios, dance spaces, or sports fields — all in one place, ready when you are.</p>
  </div>
</div>

<div class="container mt-3">
  <div class="row">
    <div class="col-md-3 d-flex flex-wrap h-auto">
      <div class="w-100 w-md-auto" style="height: 150px;">
        <div class="rounded border d-flex flex-column justify-content-center align-items-center text-white text-center" style="height: 100%; background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('{{ asset('images/studio-bg.jpg') }}') center/cover no-repeat">
          <h3 style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Studio</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 d-flex flex-wrap h-auto">
      <div class="w-100 w-md-auto" style="height: 150px;">
        <div class="rounded border d-flex flex-column justify-content-center align-items-center text-white text-center" style="height: 100%; background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('{{ asset('images/field-bg.jpg') }}') center/cover no-repeat">
          <h3 style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Field</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 d-flex flex-wrap h-auto">
      <div class="w-100 w-md-auto" style="height: 150px;">
        <div class="rounded border d-flex flex-column justify-content-center align-items-center text-white text-center" style="height: 100%; background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('{{ asset('images/co-working-bg.jpg') }}') center/cover no-repeat">
          <h3 style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Co-Working</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3 d-flex flex-wrap h-auto">
      <div class="w-100 w-md-auto" style="height: 150px;">
        <div class="rounded border d-flex flex-column justify-content-center align-items-center text-white text-center" style="height: 100%; background:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.4)), url('{{ asset('images/meeting-bg.jpg') }}') center/cover no-repeat">
          <h3 style="text-shadow: 2px 2px 6px rgba(0,0,0,0.8);">Meeting</h3>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container py-5">
  <div class="row mb-2">
    <div class="col-md-12">
      <h2>Popular Places</h2>
    </div>
  </div>

  <div class="row">
    @forelse ($places as $place)
      <div class="col-md-4 mb-3">
        <div class="card overflow-hidden h-100">
          <div style="height: 200px;" class="overflow-hidden">
            <img src={{ asset('testingimg.jpg') }} alt="" width="100%">
          </div>
          <div class="card-body">
            <div class="mb-2 d-flex justify-content-between align-items-center">
              @include('components.categoryBadge', ['category' => $place->place_type])
              <span><i class="bi bi-star-fill text-warning"></i>4/5 <span class="text-muted">(100 Visitor)</span></span>
            </div>
            <h4>{{ 'Rp. ' . number_format($place->place_price_per_hour, 0, ',', '.') }}/Hour</h4>

            <h5 class="text-capitalize">{{ $place->place_name }}</h5>

            @if ($place->place_location_url)
              <a href="{{ $place->place_location_url }}" target="_blank" class="d-block mb-3 text-decoration-none text-primary">
                <i class="bi bi-geo-alt-fill"></i> See Maps
              </a>
            @else
              <span class="d-block mb-3 text-muted" style="cursor: not-allowed;">
                <i class="bi bi-geo-alt-fill"></i> See Maps (Unavailable)
              </span>
            @endif

            <a href="/place/{{ $place->id }}" class="btn btn-outline-info w-100">
              <i class="bi-book-half"></i>
              <span class="ms-1">
                See Schedule
              </span>
            </a>
          </div>
        </div>
      </div>
    @empty 
      <div class="col-12 d-flex align-items-center justify-content-center" style="height: 100%;">
        <p class="text-muted fs-5">Not places has been added</p>
      </div>
    @endforelse
  </div>

  <div class="mt-2 text-center">
    <a href="/places" class="text- info">More Places</a>
  </div>
</div>

<div class="container py-5">
  <div class="row mb-2">
    <div class="col-md-12">
      <h2>Testimonials</h2>
    </div>
  </div>

  <div id="testimonialCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">

      <!-- Testimoni 1 -->
      <div class="carousel-item active">
        <div class="row">
          <div class="col-md-12 text-center d-flex justify-content-center">
            <div style="max-width: 700px;">
              <div class="rounded-circle overflow-hidden mb-3 mx-auto" style="width: 120px; height: 120px;">
                <img src="{{ asset('images/profile/default.png') }}" alt="profile user"
                    style="width: 100%; height: 100%; object-fit: cover;">
              </div>

              <h5 class="mb-1">Sarah Span</h5>
              <span class="text-muted mb-3 d-block">Owner Studio EMG</span>

              <p class="px-3" style="font-family: Arial, sans-serif;">
                “Since I started using <strong>HubHaven</strong>, managing bookings for my studio has become
                incredibly simple. I can focus more on growing my business instead of dealing with scheduling
                conflicts.”
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Testimoni 2 -->
      <div class="carousel-item">
        <div class="row">
          <div class="col-md-12 text-center d-flex justify-content-center">
            <div style="max-width: 700px;">
              <div class="rounded-circle overflow-hidden mb-3 mx-auto" style="width: 120px; height: 120px;">
                <img src="{{ asset('images/profile/default.png') }}" alt="profile user"
                    style="width: 100%; height: 100%; object-fit: cover;">
              </div>

              <h5 class="mb-1">Raka Andrian</h5>
              <span class="text-muted mb-3 d-block">Freelancer & Musician</span>

              <p class="px-3" style="font-family: Arial, sans-serif;">
                “With <strong>HubHaven</strong>, finding and booking creative spaces has never been easier.
                I love how simple and fast everything is — total game-changer for freelancers like me.”
              </p>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Carousel controls -->
    <button class="carousel-control-prev btn" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

</div>


<footer class="mt-auto bg-dark" style="color: #faeded; padding: 3rem 0;">
  <div class="container">
    <div class="row">
      <div class="col-md-3 mb-3">
        <h5>About Us</h5>
        <p>HubHaven is your all-in-one space booking platform — from meeting rooms and music studios to dance spaces and sports fields. We make it easy to discover, book, and manage the perfect place for your needs, anytime and anywhere.</p>
      </div>
      <div class="col-md-3 mb-3">
        <h5>Social Media</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-white">Home</a></li>
          <li><a href="#" class="text-decoration-none text-white">Services</a></li>
          <li><a href="#" class="text-decoration-none text-white">Contact</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-3">
        <h5>Assets in this website</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none text-white">Home</a></li>
          <li><a href="#" class="text-decoration-none text-white">Services</a></li>
          <li><a href="#" class="text-decoration-none text-white">Contact</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-3">
        <h5>Follow Us</h5>
        <ul class="list-inline social-icons">
          <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-facebook"></i></a></li>
          <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-twitter"></i></a></li>
          <li class="list-inline-item"><a href="#" class="text-white"><i class="bi bi-instagram"></i></a></li>
        </ul>
      </div>
    </div>
    <hr class="mb-4">
    <div class="row">
      <div class="col-md-12 text-center">
        <p>&copy; 2025 HubHaven. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
@endsection