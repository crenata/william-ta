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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset("style.css") }}" />
    <link rel="stylesheet" href="{{ asset("font-awesome.min.css") }}" />
    <link rel="stylesheet" href="{{ asset("themify-icons.css") }}" />
    <link rel="stylesheet" href="{{ asset("flaticon.css") }}" />
    <link rel="stylesheet" href="{{ asset("animate.css") }}" />
    <link rel="stylesheet" href="{{ asset("jquery-ui.css") }}" />
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset("style1.css") }}" />
    <link rel="stylesheet" href="{{ asset("responsive.css") }}" />

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
    <header class="header_area">
    <div class="top_menu">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="float-left">
              <p>Phone: +01 256 25 235</p>
              <p>email: info@eiser.com</p>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="text-end">
              <ul class="right_side">
                <li>
                  <a href="cart.html">
                    gift card
                  </a>
                </li>
                <li>
                  <a href="tracking.html">
                    track order
                  </a>
                </li>
                <li>
                  <a href="contact.html">
                    Contact Us
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main_menu">

        <nav class="navbar navbar-expand-lg navbar-light w-100">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.html">
            <img src="{{ asset("logo.png") }}" width="163" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100" id="navbarSupportedContent">
            <div class="row w-100 mr-0">
              <div class="col-lg-7 pr-0">
                <ul class="nav navbar-nav center_nav pull-right">
                  <li class="nav-item active">
                    <a class="nav-link" href="index.html">Home</a>
                  </li>
                  <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="category.html">Shop Category</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="single-product.html">Product Details</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="checkout.html">Product Checkout</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="cart.html">Shopping Cart</a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Blog</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="blog.html">Blog</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="single-blog.html">Blog Details</a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item submenu dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                      aria-expanded="false">Pages</a>
                    <ul class="dropdown-menu">
                      <li class="nav-item">
                        <a class="nav-link" href="tracking.html">Tracking</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="elements.html">Elements</a>
                      </li>
                    </ul>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                  </li>
                </ul>
              </div>

              <div class="col-lg-5 pr-0">
                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                  <li class="nav-item">
                    <a href="#" class="icons">
                      <i class="ti-search" aria-hidden="true"></i>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="icons">
                      <i class="ti-shopping-cart"></i>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="icons">
                      <i class="ti-user" aria-hidden="true"></i>
                    </a>
                  </li>

                  <li class="nav-item">
                    <a href="#" class="icons">
                      <i class="ti-heart" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>

        <main class="py-4 app-content">
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
                &copy; 2023 Copyright:
                <a>Vijipi Furniture</a>
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

        window.socket = new WebSocket("ws://localhost:{{ env("WEBSOCKET_PORT") }}");
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

    <script src="{{ asset("stellar.js") }}"></script>
</body>
</html>
