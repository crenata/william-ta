@extends("layouts.app")

@section("content")
<br>
<div class="container">
    @if (session("status"))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session("status") }}
            <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-4 offset-md-2">
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
        <div class="col-12 col-md-3">
            <h3 class="m-0 fw-bold">{{ $product->name }}</h3>
            <div class="mt-2">
                <h5 class="m-0 fw-semibold {{ empty($product->offer_price) ? "" : "text-decoration-line-through" }}">Rp{{ number_format($product->price) }}</h5>
                <h5 class="m-0 fw-semibold {{ empty($product->offer_price) ? "d-none" : "" }}">Rp{{ number_format($product->offer_price) }}</h5>
            </div>
            <div class="mt-2">
                <h5 class="m-0 fw-semibold">Stock : {{ number_format($product->stock) }}</h5>
            </div>

            <form method="POST" id="product-form" action="{{ route("cart.store") }}">
                @csrf
                <input
                    id="product_id"
                    type="number"
                    class="d-none"
                    name="product_id"
                    value="{{ $product->id }}"
                    autocomplete="product_id"
                    autofocus
                    min="1"
                    required
                />

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
                        required
                    />
                    @error("quantity")
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                    @enderror
                </div>

                <div class="mt-3">
                    <a href="{{ route("wishlist.show", $product->id) }}" class="btn btn-secondary">
                        {{ __("Wishlist") }}
                    </a>
                    <button
                        onclick="
                            document.getElementById('product-form').setAttribute('action', '{{ route("cart.store") }}');
                            document.getElementById('product-form').submit();
                        "
                        class="btn btn-info ms-3"
                    >
                        {{ __("Cart") }}
                    </button>
                    <button
                        onclick="
                            @auth()
                            buy({{ $product }}, document.getElementById('quantity').value, '{{ auth()->user()->name }}');
                            @endauth
                            document.getElementById('product-form').setAttribute('action', '{{ route("buy") }}');
                            document.getElementById('product-form').submit();
                            "
                        class="btn btn-primary ms-3"
                    >
                        {{ __("Buy") }}
                    </button>
                </div>
                <div class="mt-3">
                    <a href="https://twitter.com/intent/tweet?text={{ url()->current() }}">
                        <i class="fa-brands fa-square-twitter fa-2xl"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" class="ms-3">
                        <i class="fa-brands fa-square-facebook fa-2xl"></i>
                    </a>
                    <a href="https://wa.me/?text={{ url()->current() }}" class="ms-3">
                        <i class="fa-brands fa-square-whatsapp fa-2xl"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-4">
        <h3 class="m-0 fw-bold">Description</h3>
        <br>
        <p class="m-0">{!! $product->description !!}</p>
    </div>

        <div class="mt-4">
            <h3 class="m-0 fw-bold">Reviews</h3>
            <br>
            @foreach($product->reviews as $review)
                <div class="border rounded p-3 mt-3">
                    <p class="m-0 fw-bold">{{ $review->user->name }}</p>
                    <p class="m-0">{{ $review->review }}</p>
                    <div class="row mt-3">
                        @foreach($review->attachments as $attachment)
                            <div class="col-12 col-md-2">
                                @if(in_array(strtolower(pathinfo($attachment->attachment, PATHINFO_EXTENSION)), ["png", "jpg", "jpeg"]))
                                    <img src="{{ $attachment->attachment }}" alt="Attachment" class="w-100">
                                @else
                                    <video width="100%" controls>
                                        <source src="{{ $attachment->attachment }}" type="video/{{ pathinfo($attachment->attachment, PATHINFO_EXTENSION) }}">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
</div>
@endsection
