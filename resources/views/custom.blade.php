@extends("layouts.app")

@section("content")
<div class="img-wrap">
        <img src="{{ asset("custom.jpg") }}" alt="Image" class="img-fluid">
</div>
<br>
    <div class="container">
        <h2 class="m-0 text-center fw-bold">Produk apa saja yang bisa di custom?</h2>
        <div class="row mt-4">
            @foreach($categories as $category)
                <div class="col-12 col-md-3">
                    <img src="{{ $category->image }}" alt="Category" class="w-100" style="height: 19rem; object-fit: cover;">
                    <h3 class="text-center fw-bold">{{ $category->name }}</h3>
                </div>
            @endforeach
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

        <div class="mt-5">
            <h2 class="m-0 text-center fw-bold">Pemesanan Custom</h2>
            <form method="POST" action="{{ route("custom-user.store") }}" enctype="multipart/form-data">
                @csrf

                <div class="row mt-3">
                    <div class="col-12 col-md-6">
                        <div class="">
                            <label for="product_id">{{ __("Product") }}</label>
                            <select
                                id="product_id"
                                class="form-select @error("product_id") is-invalid @enderror"
                                name="product_id"
                                required
                                autocomplete="product_id"
                                autofocus
                            >
                                <option>Choose Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-product="{{ $product }}" {{ $product->id === old("product_id") ? "selected" : "" }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error("product_id")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <div class="mt-2">
                                <img src="{{ asset("logo.png") }}" id="product-image" alt="Image" class="w-100" style="object-fit: contain; height: 19rem;">
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="user_address_id">{{ __("Address") }}</label>
                            <select
                                id="user_address_id"
                                class="form-select @error("user_address_id") is-invalid @enderror"
                                name="user_address_id"
                                required
                                autocomplete="user_address_id"
                                autofocus
                            >
                                <option>Choose Address</option>
                                @foreach($userAddresses as $userAddress)
                                    <option value="{{ $userAddress->id }}" {{ $userAddress->id === old("user_address_id") ? "selected" : "" }}>{{ $userAddress->name }} (Rp{{ number_format($userAddress->area->fee) }})</option>
                                @endforeach
                            </select>
                            @error("user_address_id")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="model">{{ __("Model") }}</label>
                            <input
                                id="model"
                                type="text"
                                class="form-control @error("model") is-invalid @enderror"
                                name="model"
                                value="{{ old("model") }}"
                                required
                                autocomplete="model"
                                autofocus
                                placeholder="Contoh : Modern Minimalis"
                            />
                            @error("model")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-3 mt-md-0">
                        <div class="">
                            <label for="size">{{ __("Size") }}</label>
                            <input
                                id="size"
                                type="text"
                                class="form-control @error("size") is-invalid @enderror"
                                name="size"
                                value="{{ old("size") }}"
                                required
                                autocomplete="size"
                                autofocus
                                placeholder="Contoh : 10cm x 20cm x 30cm"
                            />
                            @error("size")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="color">{{ __("Color") }}</label>
                            <input
                                id="color"
                                type="text"
                                class="form-control @error("color") is-invalid @enderror"
                                name="color"
                                value="{{ old("color") }}"
                                required
                                autocomplete="color"
                                autofocus
                                placeholder="Contoh : Dark Brown"
                            />
                            @error("color")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="material">{{ __("Material") }}</label>
                            <input
                                id="material"
                                type="text"
                                class="form-control @error("material") is-invalid @enderror"
                                name="material"
                                value="{{ old("material") }}"
                                required
                                autocomplete="material"
                                autofocus
                                placeholder="Contoh : Kayu Mahoni"
                            />
                            @error("material")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="quantity">{{ __("Quantity") }}</label>
                            <input
                                id="quantity"
                                type="number"
                                class="form-control @error("quantity") is-invalid @enderror"
                                name="quantity"
                                value="{{ old("quantity") }}"
                                required
                                autocomplete="quantity"
                                autofocus
                                placeholder="Minimal 1"
                            />
                            @error("quantity")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="estimate">{{ __("Perkiraan Waktu Pembuatan") }}</label>
                            <input
                                id="estimate"
                                type="text"
                                class="form-control @error("estimate") is-invalid @enderror"
                                name="estimate"
                                value="{{ old("estimate") }}"
                                required
                                autocomplete="estimate"
                                autofocus
                            />
                            @error("estimate")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="estimate_price">{{ __("Perkiraan Harga") }}</label>
                            <input
                                id="estimate_price"
                                type="text"
                                class="form-control @error("estimate_price") is-invalid @enderror"
                                name="estimate_price"
                                value="{{ old("estimate_price") }}"
                                required
                                autocomplete="estimate_price"
                                autofocus
                            />
                            <p>*waktu pembuatan dan harga bisa lebih atau kurang dari perkiraan</p>
                            @error("estimate_price")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-success">
                        {{ __("Order") }}
                    </button>
                </div>
            </form>
        </div>

        <script>
            let estimate = document.getElementById("estimate");
            let estimatePrice = document.getElementById("estimate_price");
            let productImage = document.getElementById("product-image");
            let quantity = document.getElementById("quantity");
            let product = document.getElementById("product_id");
            let data = null;
            const setData = (qty) => {
                productImage.setAttribute("src", data.images[0].image);
                if (qty) {
                    estimate.value = `${data.duration * qty || 1} ${data.duration_type}`;
                    estimatePrice.value = `Rp${new Intl.NumberFormat().format(data.start_price * qty || 1)} - Rp${new Intl.NumberFormat().format(data.end_price * qty || 1)}`;
                } else {
                    estimate.value = `${data.duration} ${data.duration_type}`;
                    estimatePrice.value = `Rp${new Intl.NumberFormat().format(data.start_price)} - Rp${new Intl.NumberFormat().format(data.end_price)}`;
                }
            };
            product.addEventListener("change", function () {
                data = JSON.parse(this.options[this.selectedIndex].getAttribute("data-product"));
                setData();
            });
            quantity.addEventListener("keyup", function (event) {
                setData(event.target.value);
            });
        </script>
    </div>
@endsection
