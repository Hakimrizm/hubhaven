<!doctype html>
<html lang="en" data-bs-theme="dark">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
      .gallery-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 10px;
    }

    .img-wrapper {
      position: relative;
      width: 100%;
      height: 100%;
    }

    .overlay {
      position: absolute;
      bottom: 10px;
      right: 10px;
      background-color: rgba(0,0,0,0.6);
      color: #fff;
      padding: 5px 10px;
      font-size: 14px;
      border-radius: 5px;
    }

    .gallery-container {
      height: 500px;
    }

    .h-50 {
      height: 50%;
    }

    @media (max-width: 768px) {
      .gallery-container,
      .h-50 {
        height: auto;
      }
    }
    </style>
  </head>
  <body>
    @include('components.navbar')
    @yield('content')
    <script src="{{ asset('js/app.js') }}" type="module"></script>
  </body>
</html>