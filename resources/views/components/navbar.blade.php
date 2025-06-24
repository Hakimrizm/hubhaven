<nav class="navbar navbar-expand-lg position-sticky top-0 z-3" id="main-navbar">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img src="{{ asset('/images/logo.png') }}" alt="Bootstrap" width="30">
      <span class="ms-2 d-block">Hub<span class="text-info">Haven</span></span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/places">Places</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Co-Working</a></li>
            <li><a class="dropdown-item" href="#">Meeting Room</a></li>
            <li><a class="dropdown-item" href="#">Studio</a></li>
            <li><a class="dropdown-item" href="#">Field</a></li>
            <li><a class="dropdown-item" href="#">Etc</a></li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        @guest
          <li class="nav-item">
            <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="/register">Register</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-info {{ Request::is('/register/partner') ? 'active' : '' }}" href="{{ route('register.partner') }}">Register as Partner</a>
          </li>
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              @can('viewAny', \App\Models\Place::class)
                <li><a class="dropdown-item" href="{{ route('profile.show', ['profile' => auth()->user()->partner->id]) }}">Profile</a></li>
                <li><a class="dropdown-item" href="/dashboard">Dashboard</a></li>
                <li><a class="dropdown-item" href="#">My Places</a></li>
              @else
                <li><a class="dropdown-item" href="route('userProfile.show')">Profile</a></li>
              @endcan
              <li><hr class="dropdown-divider"></li>
              <li>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-left"></i> Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>