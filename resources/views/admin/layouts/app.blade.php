<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(["resources/sass/app.scss", "resources/js/app.js"])

    <style>
        .nav-admin .nav-link:hover {
            background-color: #729f89;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-success shadow-sm nav-admin">
            <div class="container">
                <a class="navbar-brand" href="{{ url("/") }}">
                    <img src="{{ asset("logo.png") }}" alt="Logo" width="120">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __("Toggle navigation") }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has("admin.login"))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route("login") }}">{{ __("Login") }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route("transaction.index") }}">{{ __("Transactions") }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route("custom.index") }}">{{ __("Custom") }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route("product.index") }}">{{ __("Products") }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route("category.index") }}">{{ __("Categories") }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route("province.index") }}">{{ __("Provinces") }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route("city.index") }}">{{ __("Cities") }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="{{ route("admin.index") }}">{{ __("Manage Admin") }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a
                                        class="dropdown-item"
                                        href="{{ route("logout") }}"
                                        onclick="
                                            event.preventDefault();
                                            document.getElementById('logout-form').submit();
                                        "
                                    >
                                        {{ __("Logout") }}
                                    </a>

                                    <form id="logout-form" action="{{ route("logout") }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield("content")
        </main>
        <footer class="shadow bg-dark text-white py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <img src="{{ asset("logo.png") }}" alt="Logo" width="200">
                    </div>
                    <div class="col-12 col-md-3 mt-3 mt-md-0">
                        <h4>Alamat Workshop</h4>
                        <br>
                        <p class="m-0">Samping Divisi I Kostrad Blok G <br> 128 RT.04 RW.01 Kel. Kalibaru,<br> Kec. Cilodong, Kota Depok,<br> Jawa Barat</p>
                    </div>
                    <div class="col-12 col-md-3 mt-3 mt-md-0">
                        <h4>Hubungi Kami</h4>
                        <br>
                        <p class="m-0">
                        <a href="https://wa.me/6285217906821">0852-1790-6821</a>
                        </p>
                    </div>
                    <div class="col-12 col-md-3 mt-3 mt-md-0">
                        <h4>Ikuti Kami</h4>
                        <br>
                        <p class="m-0">
                        <a href="https://www.instagram.com/vijipifurniture">@vijipifurniture</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Copyright -->
            <br>
            <br>
            <div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.025);">
                © 2023 Copyright:
                <a>Vijipi Furniture</a>
            </div>
        </footer>
</body>
</html>
