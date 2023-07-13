@extends("layouts.app")

@section("content")
<div class="container">
    <div class="">
        @if (session("status"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("status") }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <br>
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="fw-bold">{{ __("Cart") }}</h3>
        </div>

        <div class="table-responsive mt-4" style="height: 75vh;">
            <table class="table">
                <thead>
                <tr>
                    <th><font size="4">Image</font></th>
                    <th><font size="4">Name</font></th>
                    <th><font size="4">Quantity</font></th>
                    <th class="text-end"><font size="4">Action</font></th>
                </tr>
                </thead>
                <tbody>
                @foreach($carts as $cart)
                    <tr>
                        <td valign="middle">
                            <img src="{{ $cart->product->images[0]->image }}" alt="" width="150" height="150" style="object-fit: cover;">
                        </td>
                        <td valign="middle">
                            <a href="{{ route("product", $cart->product->id) }}" class="text-decoration-none text-body"><font size="4">{{ $cart->product->name }}</font></a>
                        </td>
                        <td valign="middle">{{ number_format($cart->quantity) }}</td>
                        <td valign="middle" class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __("Action") }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <form method="POST" action="{{ route("cart.destroy", $cart->id) }}">
                                        @csrf
                                        @method("DELETE")
                                        <li><button class="dropdown-item" type="submit">{{ __("Delete") }}</button></li>
                                    </form>
                                    <li>
                                        <a
                                            class="dropdown-item buy"
                                            href="javascript:void(0)"
                                            data-bs-toggle="modal"
                                            data-bs-target="#buy-modal"
                                            data-cart="{{ $cart }}"
                                        >{{ __("Buy") }}</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $carts->links() }}
    </div>

    <div class="modal fade" id="buy-modal" tabindex="-1" aria-labelledby="buy-modal-label" aria-hidden="true">
        <form method="POST" action="{{ route("buy") }}" class="modal-dialog">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Buy</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input
                        id="product_id"
                        type="number"
                        class="form-control d-none"
                        name="product_id"
                        value=""
                        required
                        autocomplete="product_id"
                        autofocus
                    />
                    <input
                        id="quantity"
                        type="number"
                        class="form-control d-none"
                        name="quantity"
                        value=""
                        required
                        autocomplete="quantity"
                        autofocus
                    />
                    <input
                        id="is_cart"
                        type="number"
                        class="form-control d-none"
                        name="is_cart"
                        value="1"
                        required
                        autocomplete="is_cart"
                        autofocus
                    />

                    <div class="">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let buys = document.getElementsByClassName("buy");
        let productId = document.getElementById("product_id");
        let quantity = document.getElementById("quantity");
        for (let i = 0; i < buys.length; i++) {
            let buy = buys[i];
            buy.onclick = function () {
                let data = JSON.parse(this.getAttribute("data-cart"));
                productId.value = data.product_id;
                quantity.value = data.quantity;
            }
        }
    </script>
</div>
@endsection
