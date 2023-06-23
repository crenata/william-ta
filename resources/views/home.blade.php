@extends("layouts.app")

@section("content")
    <div class="container">
        <img src="{{ asset("tentang.jpg") }}" alt="Logo" width="100%">
        <br>
        <br>
        <br>
        <h2 class="m-0 text-center fw-bold">Mengapa Memilih Kami?</h2>
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
                <div id="recommended-products-carousel" class="carousel slide multi-carousel mt-4" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach($recommendedProducts as $key => $product)
                            <div class="carousel-item {{ $key === 0 ? "active" : "" }}">
                                <div class="col-md-3 px-3">
                                    <a href="{{ route("product", $product->id) }}" class="card text-decoration-none text-body">
                                        <img src="{{ $product->images[0]->image }}" class="card-img-top" style="max-height: 200px" alt="{{ $product->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="m-0 {{ empty($product->offer_price) ? "" : "text-decoration-line-through" }}">Rp {{ number_format($product->price) }}</p>
                                            <p class="m-0 {{ empty($product->offer_price) ? "d-none" : "" }}">Rp {{ number_format($product->offer_price) }}</p>
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
                                    <a href="{{ route("product", $product->id) }}" class="card text-decoration-none text-body">
                                        <img src="{{ $product->images[0]->image }}" class="card-img-top" style="max-height: 200px" alt="{{ $product->name }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="m-0 {{ empty($product->offer_price) ? "" : "text-decoration-line-through" }}">Rp {{ number_format($product->price) }}</p>
                                            <p class="m-0 {{ empty($product->offer_price) ? "d-none" : "" }}">Rp {{ number_format($product->offer_price) }}</p>
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
        <br>
        <div class="mt-5">
        <img src="{{ asset("kelebihan.jpg") }}" alt="Logo" width="100%">
        </div>
        <br>
        <div class="mt-5">
            <div class="mt-4">
                <h3 class="m-0 text-center fw-bold">Workshop {{ config("app.name") }}</h3>
                <div id="workshops-carousel" class="carousel slide multi-carousel mt-4" data-bs-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        @foreach(range(1, 3) as $key => $workshop)
                            <div class="carousel-item {{ $key === 0 ? "active" : "" }}">
                                <div class="col-md-3 px-3">
                                    <div class="card">
                                        <img src="{{ asset("workshops/workshop-$workshop.jpg") }}" class="card-img-top" alt="Workshop">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#workshops-carousel" role="button"
                       data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    </a>
                    <a class="carousel-control-next" href="#workshops-carousel" role="button"
                       data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    </a>
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

            let workshops = document.querySelectorAll("#workshops-carousel .carousel-item");
            workshops.forEach((el) => {
                const minPerSlide = 4;
                let next = el.nextElementSibling;
                for (let i = 1; i < minPerSlide; i++) {
                    if (!next) next = workshops[0];
                    let cloneChild = next.cloneNode(true);
                    el.appendChild(cloneChild.children[0]);
                    next = next.nextElementSibling;
                }
            });
        </script>
    </div>
@endsection
