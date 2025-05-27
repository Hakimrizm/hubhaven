<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="./index.html" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="{{ asset('/images/logo.png') }}"
        alt="AdminLTE Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">Hub<span class="text-info">Haven</span></span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="menu"
        data-accordion="false"
      >
        <li class="nav-item">
          <a href="/dashboard" class="nav-link">
            <i class="nav-icon bi bi-columns-gap"></i>
            <p>Dashboard</p>
          </a>
        </li>

        @can('viewAny', \App\Models\Place::class)    
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-building-gear"></i>
              <p>Manage my place
                <i class="nav-arrow bi bi-chevron-right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <div class="nav-item">
                <a href="/dashboard/place" class="nav-link">
                  <i class="nav-icon bi bi bi-buildings""></i>
                  <p>My Places</p>
                </a>
              </div>
            </ul>
            <ul class="nav nav-treeview">
              <div class="nav-item">
                <a href="/dashboard/place/create" class="nav-link">
                  <i class="nav-icon bi bi-building-fill-add"></i>
                  <p>Add Places</p>
                </a>
              </div>
            </ul>
            <ul class="nav nav-treeview">
              <div class="nav-item">
                <a href="{{ route('profile.show', ['profile' => auth()->user()->partner->id]) }}" class="nav-link">
                  <i class="nav-icon bi bi-building-fill"></i>
                  <p>Company Profile</p>
                </a>
              </div>
            </ul>
          </li>

          <div class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi-book-half"></i>
              <p>Book</p>
            </a>
          </div>

          <div class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-clock-history"></i>
              <p>Book History</p>
            </a>
          </div>

          <div class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon bi bi-chat-left-dots-fill"></i>
              <p>Review</p>
            </a>
          </div>
        @endcan
        {{-- <li class="nav-header">EXAMPLES</li> --}}
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>