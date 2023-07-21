<!doctype html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset("logo.png") }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config("app.name", "Laravel") }}</title>

    <!-- Bootstrap CSS -->

		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="{{ asset("style.css") }}" rel="stylesheet">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <!-- Scripts -->
    @vite(["resources/sass/app.scss", "resources/js/app.js"])
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"
        integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    ></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key={{ env("MAPS_API_KEY") }}&sensor=false&libraries=places"></script>
    <script type="text/javascript" src="https://rawgit.com/Logicify/jquery-locationpicker-plugin/master/dist/locationpicker.jquery.js"></script>

    <style>
        .app-content {
            margin-top: 5rem;
            margin-bottom: 18rem;
        }
        .whatsapp-bottom {
            width: 70px;
            left: 1rem;
            bottom: 1rem;
        }
        .chat-bottom {
            left: calc(100vw - 70px - 1rem);
            bottom: 1rem;
            background-color: #228B22;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .chat-box-bottom {
            background-color: #FFFFFF;
            width: 20rem;
            height: 24rem;
            left: calc(100vw - 20rem - 1rem);
            bottom: 1rem;
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
        .nav-user .nav-link:hover {
            background-color: #729f89;
        }
        .bgc-87CEFA {
            background-color: #87CEFA;
        }
        .bgc-32CD32 {
            background-color: #32CD32;
        }
        @media (min-width: 768px) {
            .app-content {
                margin-bottom: 10rem;
            }
            .whatsapp-bottom {
                left: 2rem;
            }
            .chat-bottom {
                left: calc(100vw - 70px - 2rem);
            }
            .chat-box-bottom {
                width: 20rem;
                height: 30rem;
                left: calc(100vw - 20rem - 2rem);
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
    <nav class="navbar navbar-expand-md navbar-light bg-success fixed-top nav-user">
            <div class="">
                <a class="navbar-brand" href="{{ url("/") }}">
                    <img src="{{ asset("logo.png") }}" alt="Logo" width="164">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __("Toggle navigation") }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ url("/") }}">{{ __("Home") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route("products") }}">{{ __("Products") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route("offers") }}">{{ __("Promo") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route("product.custom") }}">{{ __("Custom") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route("faq") }}">{{ __("FAQ") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route("about") }}">{{ __("About") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route("contact") }}">{{ __("Contact") }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route("return-policy") }}">{{ __("Return") }}</a>
                        </li>
                    </ul>

                    <form class="d-flex" role="search" action="{{ route("products") }}" method="GET">
                        <input class="form-control me-1" type="search" name="search" placeholder="Cari produk disini...">
                        <button class="btn btn-warning" type="submit">Search</button>
                    </form>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has("login"))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route("login") }}">{{ __("Log in") }}</a>
                                </li>
                            @endif

                            @if (Route::has("register"))
                                <li class="nav-item">
                                    <a class="nav-link text-white" href="{{ route("register") }}">{{ __("Register") }}</a>
                                </li>
                            @endif
                        @else

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route("wishlist.index") }}">
                                        <img src="{{ asset("love.png") }}" width="30" height="30">
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route("cart.index") }}">
                                        <img src="{{ asset("cart.svg") }}" width="26" height="26">
                                    </a>
                                </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ asset("user.svg") }}" width="26" height="26">&nbsp;&nbsp;{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a
                                        class="dropdown-item"
                                        href="{{ route("account.index") }}"
                                    >
                                    <img src="{{ asset("akun1.svg") }}" width="30" height="25">{{ __("Account") }}
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route("address.index") }}"
                                    >
                                    <img src="{{ asset("location.svg") }}" width="30" height="25">{{ __("Addresses") }}
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route("transaction-user.index") }}"
                                    >
                                    <img src="{{ asset("order.svg") }}" width="31" height="23">{{ __("Transaction") }}
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route("custom-user.index") }}"
                                    >
                                    <img src="{{ asset("custom.svg") }}" width="30" height="25">{{ __("Custom Transaction") }}
                                    </a>
                                    <a
                                        class="dropdown-item"
                                        href="{{ route("logout") }}"
                                        onclick="
                                            event.preventDefault();
                                            document.getElementById('logout-form').submit();
                                        "
                                    >
                                    <img src="{{ asset("logout.svg") }}" width="31" height="27">{{ __("Logout") }}
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

        <footer class="shadow bg-dark text-white py-4">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <img src="{{ asset("logo.png") }}" alt="Logo" width="170">
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
                        <a href="https://wa.me/6285217906821" class="text-reset">0852-1790-6821</a>
                        </p>
                    </div>
                    <div class="col-12 col-md-3 mt-3 mt-md-0">
                        <h4>Ikuti Kami</h4>
                        <br>
                        <p class="m-0">
                        <a href="https://www.instagram.com/vijipifurniture" class="text-reset">@vijipifurniture</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Copyright -->
            <br>
            <br>
            <div class="text-center p-2" style="background-color: rgba(0, 0, 0, 0.025);">
                <a><font size="3">Vijipi Furniture</font></a>
            </div>
        </footer>

        <a href="https://wa.me/6285217906821" class="fixed-bottom whatsapp-bottom">
            <img src="{{ asset("whatsapp.png") }}" alt="Whatsapp" width="70">
        </a>

        <a href="javascript:void(0)" class="fixed-bottom chat-bottom" onclick="document.getElementById('chat-box').classList.toggle('d-none')">
            <img src="{{ asset("logo.png") }}" alt="Chat" width="70">
        </a>

        <div class="fixed-bottom chat-box-bottom d-none" id="chat-box">
            <div class="position-relative h-100">
                <div class="px-2 py-1 d-flex align-items-center justify-content-between bgc-32CD32">
                    <img src="{{ asset("logo.png") }}" alt="Chat" width="80">
                    <button class="btn-close" onclick="document.getElementById('chat-box').classList.toggle('d-none')"></button>
                </div>
                <div class="app-chat px-2" id="app-chat">
                    <div class="mt-2 d-flex">
                        <div class="app-chat-content bgc-32CD32 rounded p-2">
                            <p class="m-0">Selamat datang di Vijipi Furniture! Ada yang bisa kami bantu?</p>
                        </div>
                    </div>
                </div>
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
                    <div class="app-chat-content bgc-32CD32 rounded p-2">
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
                        <div class="app-chat-content bgc-87CEFA rounded p-2">
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
                        appChat.insertAdjacentHTML("afterbegin", answer("Hmm... maaf saya tidak mengerti!"));
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

        window.socket = new WebSocket("ws://103.82.92.212:{{ env("WEBSOCKET_PORT") }}");
        window.socket.onopen = (event) => {
            console.log("onopen", event);
        };
        window.socket.onclose = (event) => {
            console.log("onclose", event);
        };
        window.socket.onerror = (event) => {
            console.log("onerror", event);
        };
        window.socket.onmessage = (event) => {
            console.log("onmessage", event);
            let data = JSON.parse(event?.data);
            Toastify({
                text: `${data.username} has bought ${data.name} ${new Intl.NumberFormat().format(data.quantity)}x at a price of Rp${new Intl.NumberFormat().format(data.quantity * (data.offer_price || data.price))}`,
                duration: 20000
            }).showToast();
        };

        function buy(data, quantity, username) {
            window.socket.send(JSON.stringify({...data, quantity, username}));
        }
    </script>
		<script src="{{ asset("custom.js") }}"></script>
</body>
</html>
