@extends("layouts.app")

@section("content")
    <div class="container">
        @auth()
            @if (!auth()->user()->email_verified_at)
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Please verify email first!
                    <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endauth
    </div>

		<!-- Start Hero Section -->
		<div class="hero">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-5">
						<div class="intro-excerpt">
							<h1>Vijipi Furniture</h1>
                            <br>
							<p class="mb-4"><font size="4">Selalu memberi yang terbaik bagi customer kami, yaitu memproduksi produk berkualitas dengan desain terkini serta pelayanan yang prima</font></p>
							<br>
                            <p><a href="{{ route("products") }}" class="btn btn-secondary me-2"><b>Explore</b></a></p>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="hero-img-wrap">
							<img src="{{ asset("sofa4.png") }}" class="img-fluid">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Hero Section -->

		<!-- Start Why Choose Us Section -->
		<div class="why-choose-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-6">
						<h1 class="section-title fw-bold">Why Choose Us</h1>
						<div class="row my-5">
							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="{{ asset("truck.svg") }}" alt="Image" class="imf-fluid">
									</div>
									<h3 class="fw-bold"><font size="4">Delivery Service</font></h3>
									<p><font size="3">Kami mengutamakan kualitas produk serta ketepatan pengiriman (delivery) produk ke customer.</font></p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="{{ asset("design.svg") }}" alt="Image" class="imf-fluid" width="40" height="40">
									</div>
									<h3 class="fw-bold"><font size="4">Design Up to Date</font></h3>
									<p><font size="3">Desain 3D custome made, dengan model klasik, modern serta minimalis.</font></p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="{{ asset("support.svg") }}" alt="Image" class="imf-fluid">
									</div>
									<h3>24/7 Support</h3>
									<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									<div class="icon">
										<img src="{{ asset("return.svg") }}" alt="Image" class="imf-fluid">
									</div>
									<h3>Hassle Free Returns</h3>
									<p>Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
								</div>
							</div>

						</div>
					</div>

					<div class="col-lg-5">
						<div class="img-wrap">
							<img src="{{ asset("why-choose-us-img.jpg") }}" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
			</div>
<!-- End Why Choose Us Section -->
	
		<div class="container">
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

		<!-- Start We Help Section -->
		<div class="we-help-section">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-7 mb-5 mb-lg-0">
						<div class="imgs-grid">
							<div class="grid grid-1"><img src="{{ asset("img-grid-1.jpg") }}" alt="Untree.co"></div>
							<div class="grid grid-2"><img src="{{ asset("img-grid-2.jpg") }}" alt="Untree.co"></div>
							<div class="grid grid-3"><img src="{{ asset("img-grid-3.jpg") }}" alt="Untree.co"></div>
						</div>
					</div>
					<div class="col-lg-5 ps-lg-5">
						<h2 class="section-title fw-bold mb-4">Kelebihan dan Kekurangan Furniture Custom Made</h2>
						<p><font size="5">Kelebihan Furniture Custom Made:</font></p>

						<ul class="list-unstyled custom-list my-4">
							<li><font size="3">Model dan style fleksibel sesuai selera dan keinginan</font></li>
							<li><font size="3">Bahan baku terbaik sesuai dengan pilihan</font></li>
							<li><font size="3">Sesuai kebutuhan, keinginan, dan ukuran yang ada</font></li>
						</ul>

                        <p><font size="5">Kekurangan Furniture Custom Made:</font></p>

						<ul class="list-unstyled custom-list my-4">
							<li><font size="3">Membutuhkan waktu produksi lebih lama</font></li>
							<li><font size="3">Harga relatif sedikit lebih mahal</font></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End We Help Section -->

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
