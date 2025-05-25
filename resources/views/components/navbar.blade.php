<nav class="navbar navbar-expand-lg bg-secondary-subtle shadow-sm position-sticky top-0 z-3">
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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i id="theme-icon" class="bi bi-moon-stars"></i>
          </a>
          <ul class="dropdown-menu theme-menu">
            <li><button class="dropdown-item" type="button" data-theme="dark"><i class="bi bi-moon-stars"></i> Dark</button></li>
            <li><button class="dropdown-item" data-theme="light"><i class="bi bi-brightness-high-fill"></i> Light</button></li>
          </ul>
        </li>
        @guest
          <li class="nav-item">
            <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('register') ? 'active' : '' }}" href="/register">Register</a>
          </li>
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              @can('viewAny', \App\Models\Place::class)
                <li><a class="dropdown-item" href="/dashboard/profile">Profile</a></li>
                <li><a class="dropdown-item" href="#">My Places</a></li>
                <li><a class="dropdown-item" href="#">My Book</a></li>
              @else
                <li><a class="dropdown-item" href="/profile">Profile</a></li>
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