<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Geist+Mono:wght@100..900&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
      body {
        font-family: "Inter", sans-serif;
      }
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

  {{-- Photo by <a href="https://unsplash.com/@alicekat?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Alice Donovan Rouse</a> on <a href="https://unsplash.com/photos/closeup-photo-of-torn-papers-yu68fUQDvOI?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
  --}}

  {{-- 
  Photo by <a href="https://unsplash.com/@john_matychuk?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">John Matychuk</a> on <a href="https://unsplash.com/photos/music-room-with-lights-turned-on-gUK3lA3K7Yo?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
  --}}

  {{--
  Photo by <a href="https://unsplash.com/@reddfrancisco?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Redd Francisco</a> on <a href="https://unsplash.com/photos/people-sitting-on-chair-5U_28ojjgms?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
  --}}

  {{--
  Photo by <a href="https://unsplash.com/@shridhar?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Shridhar Gupta</a> on <a href="https://unsplash.com/photos/people-sitting-in-front-of-computer-monitors-dZxQn4VEv2M?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
  --}}

  {{--
  Photo by <a href="https://unsplash.com/@zacgudakov?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Zac Gudakov</a> on <a href="https://unsplash.com/photos/a-group-of-people-at-a-race-track-K_mNrmszLXM?utm_content=creditCopyText&utm_medium=referral&utm_source=unsplash">Unsplash</a>
  --}}
</html>