@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-4">
            <img
                src="{{ $product->images[0]->image }}"
                alt="{{ $product->name }}"
                class="w-100"
                id="product-image"
                style="height: 24rem; object-fit: cover;"
            >
            <div class="row mt-3">
                @foreach($product->images as $image)
                    <div class="col-3">
                        <img
                            src="{{ $image->image }}"
                            alt="{{ $product->name }}"
                            class="w-100 cursor-pointer"
                            style="height: 5rem; object-fit: cover; cursor: pointer;"
                            onclick="document.getElementById('product-image').setAttribute('src', this.src)"
                        >
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-12 col-md-8">
            <h3 class="m-0 fw-bold">{{ $product->name }}</h3>
            <div class="mt-2">
                <h5 class="m-0 fw-semibold {{ empty($product->offer_price) ? "" : "text-decoration-line-through" }}">Rp{{ number_format($product->price) }}</h5>
                <h5 class="m-0 fw-semibold {{ empty($product->offer_price) ? "d-none" : "" }}">Rp{{ number_format($product->offer_price) }}</h5>
            </div>
            <div class="mt-2">
                <h5 class="m-0 fw-semibold">Stock : {{ number_format($product->stock) }}</h5>
            </div>

            <form method="POST" action="{{ route("admin.store") }}">
                @csrf

                <div class="row mt-3">
                    <div class="col-12 col-md-3">
                        <label for="quantity">{{ __("Quantity") }}</label>
                        <input
                            id="quantity"
                            type="number"
                            class="form-control @error("quantity") is-invalid @enderror"
                            name="quantity"
                            value="{{ old("quantity") }}"
                            autocomplete="quantity"
                            autofocus
                            min="1"
                        />
                        @error("quantity")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    {{ __("Buy") }}
                </button>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <h3 class="m-0 fw-bold">Description :</h3>
        <p class="m-0">{{ $product->description }}</p>
    </div>
</div>
@endsection
