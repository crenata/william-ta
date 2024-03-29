@extends("admin.layouts.app")

@section("content")
<div class="container">
    <div class="">
        @if (session("status"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("status") }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex align-items-center justify-content-between">
            <h4 class="">{{ __("Manage Product") }}</h4>
            <a class="btn btn-sm btn-success" href="{{ route("product.create") }}">
                {{ __("Add") }}
            </a>
        </div>

        <div class="table-responsive mt-4" style="height: 75vh;">
            <table class="table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Offer Price</th>
                    <th class="text-end">Stock</th>
                    <th class="text-end">Total Purchased</th>
                    <th class="text-end">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td valign="middle">
                            <img src="{{ $product->images[0]->image }}" alt="" width="130" height="130" style="object-fit: cover;">
                        </td>
                        <td valign="middle">{{ $product->category->name }}</td>
                        <td valign="middle">{{ $product->name }}</td>
                        <td valign="middle" class="text-end">Rp {{ number_format($product->price) }}</td>
                        <td valign="middle" class="text-end">Rp {{ number_format($product->offer_price) }}</td>
                        <td valign="middle" class="text-end">{{ number_format($product->stock) }}</td>
                        <td valign="middle" class="text-end">{{ number_format($product->total_purchased) }}</td>
                        <td valign="middle" class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __("Action") }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route("product.edit", $product->id) }}">{{ __("Edit") }}</a></li>
                                    <form method="POST" action="{{ route("product.destroy", $product->id) }}">
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

        {{ $products->links() }}
    </div>
</div>
@endsection
