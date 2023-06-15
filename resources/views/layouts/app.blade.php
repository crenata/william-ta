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
        .whatsapp-bottom {
            width: 70px;
            left: 1rem;
            bottom: 18.5rem;
        }
        .chat-bottom {
            left: calc(100vw - 70px - 1rem);
            bottom: 18.5rem;
        }
        .chat-box-bottom {
            background-color: #4a5568;
            width: 20rem;
            height: 24rem;
            left: calc(100vw - 20rem - 1rem);
            bottom: 18.5rem;
        }
        .app-chat {
            padding: 1.5rem 0;
            height: 20rem;
            overflow-x: hidden;
            overflow-y: auto;
            display: flex;
            flex-direction: column-reverse;
        }
        .app-chat-content {
            max-width: 75%;
        }
        @media (min-width: 768px) {
            .app-content {
                margin-bottom: 10rem;
            }
            .whatsapp-bottom {
                left: 2rem;
                bottom: 8.5rem;
            }
            .chat-bottom {
                left: calc(100vw - 70px - 2rem);
                bottom: 8.5rem;
            }
            .chat-box-bottom {
                width: 20rem;
                height: 30rem;
                left: calc(100vw - 20rem - 2rem);
                bottom: 8.5rem;
            }
            .app-chat {
                padding: 1rem 0;
                height: 25.5rem;
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
                                        href="{{ route("transaction-user.index") }}"
                                    >
                                        {{ __("Transactions") }}
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

        <a href="https://wa.me/6285217906821" class="fixed-bottom whatsapp-bottom">
            <img src="{{ asset("whatsapp.png") }}" alt="Whatsapp" width="70">
        </a>

        <a href="javascript:void(0)" class="fixed-bottom chat-bottom" onclick="document.getElementById('chat-box').classList.toggle('d-none')">
            <img src="{{ asset("question-mark.png") }}" alt="Whatsapp" width="70">
        </a>

        <div class="fixed-bottom chat-box-bottom d-none" id="chat-box">
            <div class="position-relative h-100">
                <div class="bg-info p-2 text-end">
                    <button class="btn-close" onclick="document.getElementById('chat-box').classList.toggle('d-none')"></button>
                </div>
                <div class="app-chat px-2" id="app-chat"></div>
                <div class="position-absolute bottom-0 w-100">
                    <div class="input-group">
                        <input type="text" id="input-message" class="form-control rounded-0" placeholder="Type message..." aria-describedby="button-message">
                        <button class="btn btn-info rounded-0" id="button-message">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let appChat = document.getElementById("app-chat");
        let inputMessage = document.getElementById("input-message");
        let btnMessage = document.getElementById("button-message");
        const answer = message => {
            return `
                <div class="mt-2 d-flex">
                    <div class="app-chat-content bg-info rounded p-2">
                        <p class="m-0">${message}</p>
                    </div>
                </div>
            `;
        };
        const send = () => {
            let message = inputMessage.value;
            if (message) {
                inputMessage.value = "";
                appChat.insertAdjacentHTML("afterbegin", `
                    <div class="mt-2 d-flex justify-content-end">
                        <div class="app-chat-content bg-info rounded p-2">
                            <p class="m-0">${message}</p>
                        </div>
                    </div>
                `);
                fetch("/api/chat", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        name: message
                    })
                }).then(response => response.json())
                .then(response => {
                    if (response?.answer) {
                        appChat.insertAdjacentHTML("afterbegin", answer(response.answer.name));
                    } else {
                        appChat.insertAdjacentHTML("afterbegin", answer("Hmm... maaf saya ga ngerti!"));
                    }
                }).catch(error => {
                    appChat.insertAdjacentHTML("afterbegin", answer("Lost Connection..."));
                });
            }
        };
        btnMessage.onclick = send;
        inputMessage.addEventListener("keypress", event => {
            if (event.key === "Enter") {
                event.preventDefault();
                send();
            }
        });
    </script>
</body>
</html>
