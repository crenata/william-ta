@extends("layouts.app")

@section("content")
    
        <img src="{{ asset("tentang.jpg") }}" alt="Logo" width="100%" height="600px">
    
        <div class="container">
            <h2 class="mt-3 mb-0 text-center fw-bold">Mengapa Memilih Kami?</h2>
            <ul class="mt-4">
                <li>
                    <h4 class="m-0">Desain Terkini (Up to Date)</h4>
                    <p class="m-0">Desain 3D custome made, dengan model klasik, modern serta minimalis.</p>
                </li>
                <li class="mt-2">
                    <h4 class="m-0">Bahan Baku Terbaik (Raw Material)</h4>
                    <p class="m-0">Menggunakan bahan baku, pelengkap, dan aksesoris kualitas terbaik.</p>
                </li>
                <li class="mt-2">
                    <h4 class="m-0">Tenaga Profesional</h4>
                    <p class="m-0">Berpengalaman di bidang Furniture lebih dari 18 tahun.</p>
                </li>
                <li class="mt-2">
                    <h4 class="m-0">Harga terjangkau dan kompetitif</h4>
                    <p class="m-0">Kami berikan harga terbaik sesuai dengan bahan baku serta kualitas produk.</p>
                </li>
                <li class="mt-2">
                    <h4 class="m-0">Delivery Service</h4>
                    <p class="m-0">Kami mengutamakan kualitas produk serta ketepatan pengiriman (delivery) produk ke
                        customer.</p>
                </li>
                <li class="mt-2">
                    <h4 class="m-0">After Sales Service</h4>
                    <p class="m-0">Produk bergaransi dan kami menerima complain, kritik serta saran demi perbaikan produk
                        serta pelayanan lebih baik kepada customer setia kami.</p>
                </li>
            </ul>

            <div class="mt-5">
                <div class="mt-4">
                    <h3 class="m-0 text-center fw-bold">Recommended Products</h3>
                    <div id="recommended-products-carousel" class="carousel slide multi-carousel mt-4"
                         data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @foreach($recommendedProducts as $key => $product)
                                <div class="carousel-item {{ $key === 0 ? "active" : "" }}">
                                    <div class="col-md-3 px-3">
                                        <a href="{{ route("product", $product->id) }}"
                                           class="card text-decoration-none text-body">
                                            <img src="{{ $product->images[0]->image }}" class="card-img-top"
                                                 style="max-height: 200px" alt="{{ $product->name }}">
                                            <div class="card-body">
                                                <h4 class="card-title">{{ $product->name }}</h4>
                                                <h5 class="m-0 {{ empty($product->offer_price) ? "" : "text-decoration-line-through" }}">
                                                    Rp {{ number_format($product->price) }}</h5>
                                                <h4 class="m-0 {{ empty($product->offer_price) ? "d-none" : "" }}">
                                                    Rp {{ number_format($product->offer_price) }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#recommended-products-carousel" role="button"
                           data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next" href="#recommended-products-carousel" role="button"
                           data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
                <br>
                <div class="mt-4">
                    <h3 class="m-0 text-center fw-bold">New Products</h3>
                    <div id="new-products-carousel" class="carousel slide multi-carousel mt-4" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @foreach($newProducts as $key => $product)
                                <div class="carousel-item {{ $key === 0 ? "active" : "" }}">
                                    <div class="col-md-3 px-3">
                                        <a href="{{ route("product", $product->id) }}"
                                           class="card text-decoration-none text-body">
                                            <img src="{{ $product->images[0]->image }}" class="card-img-top"
                                                 style="max-height: 200px" alt="{{ $product->name }}">
                                            <div class="card-body">
                                                <h4 class="card-title">{{ $product->name }}</h4>
                                                <h5 class="m-0 {{ empty($product->offer_price) ? "" : "text-decoration-line-through" }}">
                                                    Rp {{ number_format($product->price) }}</h5>
                                                <h4 class="m-0 {{ empty($product->offer_price) ? "d-none" : "" }}">
                                                    Rp {{ number_format($product->offer_price) }}</h4>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#new-products-carousel" role="button"
                           data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </a>
                        <a class="carousel-control-next" href="#new-products-carousel" role="button"
                           data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <img src="{{ asset("kelebihan.jpg") }}" alt="Logo" width="100%" height="600px">
        </div>

        <div class="container">
            <div class="mt-5">
                <div class="mt-4">
                    <h3 class="m-0 text-center fw-bold">Workshop {{ config("app.name") }}</h3>
                    <div class="row mt-3">
                        @foreach(range(1, 3) as $key => $workshop)
                            <div class="col-12 col-md-4">
                                <div class="card">
                                    <img src="{{ asset("workshops/workshop-$workshop.jpg") }}" class="card-img-top"
                                         style="height: 18rem; object-fit: cover;" alt="Workshop">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <style>
            @media (max-width: 767px) {
                .multi-carousel .carousel-inner .carousel-item > div {
                    display: none;
                }

                .multi-carousel .carousel-inner .carousel-item > div:first-child {
                    display: block;
                }
            }

            .multi-carousel .carousel-inner .carousel-item.active,
            .multi-carousel .carousel-inner .carousel-item-next,
            .multi-carousel .carousel-inner .carousel-item-prev {
                display: flex;
            }

            .multi-carousel .carousel-control-prev-icon {
                background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0iY3VycmVudENvbG9yIiBjbGFzcz0iYmkgYmktY2hldnJvbi1sZWZ0IiB2aWV3Qm94PSIwIDAgMTYgMTYiPgogIDxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgZD0iTTExLjM1NCAxLjY0NmEuNS41IDAgMCAxIDAgLjcwOEw1LjcwNyA4bDUuNjQ3IDUuNjQ2YS41LjUgMCAwIDEtLjcwOC43MDhsLTYtNmEuNS41IDAgMCAxIDAtLjcwOGw2LTZhLjUuNSAwIDAgMSAuNzA4IDB6Ii8+Cjwvc3ZnPg==");
            }
            .multi-carousel .carousel-control-next-icon {
                background-image: url("data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxNiIgaGVpZ2h0PSIxNiIgZmlsbD0iY3VycmVudENvbG9yIiBjbGFzcz0iYmkgYmktY2hldnJvbi1yaWdodCIgdmlld0JveD0iMCAwIDE2IDE2Ij4KICA8cGF0aCBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik00LjY0NiAxLjY0NmEuNS41IDAgMCAxIC43MDggMGw2IDZhLjUuNSAwIDAgMSAwIC43MDhsLTYgNmEuNS41IDAgMCAxLS43MDgtLjcwOEwxMC4yOTMgOCA0LjY0NiAyLjM1NGEuNS41IDAgMCAxIDAtLjcwOHoiLz4KPC9zdmc+");
            }

            @media (min-width: 768px) {
                .multi-carousel .carousel-inner .carousel-item-end.active,
                .multi-carousel .carousel-inner .carousel-item-next {
                    transform: translateX(25%);
                }

                .multi-carousel .carousel-inner .carousel-item-start.active,
                .multi-carousel .carousel-inner .carousel-item-prev {
                    transform: translateX(-25%);
                }
            }

            .multi-carousel .carousel-inner .carousel-item-end,
            .multi-carousel .carousel-inner .carousel-item-start {
                transform: translateX(0);
            }

            .multi-carousel img {
                height: 16rem;
                object-fit: cover;
            }

            .multi-carousel .carousel-control-prev,
            .multi-carousel .carousel-control-next {
                width: 5%;
            }
        </style>

        <script>
            let recommendedProducts = document.querySelectorAll("#recommended-products-carousel .carousel-item");
            recommendedProducts.forEach((el) => {
                const minPerSlide = 4;
                let next = el.nextElementSibling;
                for (let i = 1; i < minPerSlide; i++) {
                    if (!next) next = recommendedProducts[0];
                    let cloneChild = next.cloneNode(true);
                    el.appendChild(cloneChild.children[0]);
                    next = next.nextElementSibling;
                }
            });

            let newProducts = document.querySelectorAll("#new-products-carousel .carousel-item");
            newProducts.forEach((el) => {
                const minPerSlide = 4;
                let next = el.nextElementSibling;
                for (let i = 1; i < minPerSlide; i++) {
                    if (!next) next = newProducts[0];
                    let cloneChild = next.cloneNode(true);
                    el.appendChild(cloneChild.children[0]);
                    next = next.nextElementSibling;
                }
            });
        </script>
    </div>
@endsection
