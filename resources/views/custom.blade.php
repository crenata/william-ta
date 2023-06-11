@extends("layouts.app")

@section("content")
    <div class="container">
        <h3 class="m-0 text-center fw-bold">Produk apa saja yang bisa di custom?</h3>
        <div class="row mt-4">
            @foreach($categories as $category)
                <div class="col-12 col-md-3">
                    <img src="{{ $category->image }}" alt="Category" class="w-100" style="height: 12rem; object-fit: cover;">
                </div>
            @endforeach
        </div>

        <div class="mt-5">
            <div class="mt-4">
                <h3 class="m-0 text-center fw-bold">Kelebihan Furniture Custom Made :</h3>
                <ul class="mt-4">
                    <li>Model dan style fleksibel sesuai dengan selera serta keinginan.</li>
                    <li>Sesuai kebutuhan, keinginan, ukuran serta space ruangan yang ada.</li>
                    <li>Bahan baku (raw material) terbaik sesuai dengan pilihan.</li>
                </ul>
            </div>

            <div class="mt-4">
                <h3 class="m-0 text-center fw-bold">Kekurangan Furniture Custom Made :</h3>
                <ul class="mt-4">
                    <li>Membutuhkan waktu produksi lebih lama.</li>
                    <li>Harga relatif sedikit lebih mahal.</li>
                </ul>
            </div>
        </div>

        <div class="mt-5">
            <h3 class="m-0 text-center fw-bold">Pemesanan Custom</h3>
            <form method="POST" action="{{ route("product.store") }}" enctype="multipart/form-data">
                @csrf

                <div class="row mt-3">
                    <div class="col-12 col-md-6">
                        <div class="">
                            <label for="product_id">{{ __("Product") }}</label>
                            <select
                                id="product_id"
                                type="text"
                                class="form-select @error("product_id") is-invalid @enderror"
                                name="product_id"
                                required
                                autocomplete="product_id"
                                autofocus
                            >
                                <option>Choose Product</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ $product->id === old("product_id") ? "selected" : "" }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error("product_id")
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
                            />
                            @error("model")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
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
                            />
                            @error("material")
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="">
                            <label for="type">{{ __("Type") }}</label>
                            <input
                                id="type"
                                type="text"
                                class="form-control @error("type") is-invalid @enderror"
                                name="type"
                                value="{{ old("type") }}"
                                required
                                autocomplete="type"
                                autofocus
                            />
                            @error("type")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="images">{{ __("Images") }}</label>
                            <input
                                id="images"
                                type="file"
                                class="form-control @error("images") is-invalid @enderror"
                                name="images[]"
                                value="{{ old("images") }}"
                                required
                                autocomplete="images"
                                accept="image/*"
                                multiple
                            />
                            @error("images")
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
                            />
                            @error("quantity")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="estimate">{{ __("Estimate") }}</label>
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
                            <label for="estimate_price">{{ __("Estimate Price") }}</label>
                            <input
                                id="estimate_price"
                                type="number"
                                class="form-control @error("estimate_price") is-invalid @enderror"
                                name="estimate_price"
                                value="{{ old("estimate_price") }}"
                                required
                                autocomplete="estimate_price"
                                autofocus
                            />
                            @error("estimate_price")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-primary">
                        {{ __("Order") }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
