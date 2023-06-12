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
        .app-content {
            margin-top: 5rem;
            margin-bottom: 18rem;
        }
        @media (min-width: 768px) {
            .app-content {
                margin-bottom: 10rem;
            }
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url("/") }}">
                    <img src="{{ asset("logo.png") }}" alt="Logo" width="100">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __("Toggle navigation") }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("products") }}">{{ __("Products") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("offers") }}">{{ __("Promo") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("custom") }}">{{ __("Custom") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("faq") }}">{{ __("FAQ") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("about") }}">{{ __("About Us") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("contact") }}">{{ __("Contact Us") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route("return-policy") }}">{{ __("Return Policy") }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has("login"))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route("login") }}">{{ __("Login") }}</a>
                                </li>
                            @endif

                            @if (Route::has("register"))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route("register") }}">{{ __("Register") }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a
                                        class="dropdown-item"
                                        href="{{ route("account.index") }}"
                                    >
                                        {{ __("Account") }}
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route("address.index") }}"
                                    >
                                        {{ __("Addresses") }}
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route("wishlist.index") }}"
                                    >
                                        {{ __("Wishlists") }}
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route("cart.index") }}"
                                    >
                                        {{ __("Carts") }}
                                    </a>
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

        <main class="py-4 app-content">
            @yield("content")
        </main>

        <footer class="shadow bg-white fixed-bottom py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <img src="{{ asset("logo.png") }}" alt="Logo" class="w-50">
                    </div>
                    <div class="col-12 col-md-3 mt-3 mt-md-0">
                        <p class="m-0">Samping Divisi I Kostrad Blok G 128 RT.04 RW.01 Kel. Kalibaru, Kec. Cilodong, Kota Depok, Jawa Barat</p>
                    </div>
                    <div class="col-12 col-md-3 text-start text-md-end mt-3 mt-md-0">
                        <a href="https://wa.me/6285217906821">0852-1790-6821</a>
                    </div>
                    <div class="col-12 col-md-3 text-start text-md-end mt-3 mt-md-0">
                        <a href="https://www.instagram.com/vijipifurniture">@vijipifurniture</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
