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
</div>
@endsection
