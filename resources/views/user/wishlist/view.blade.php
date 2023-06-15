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

        <div class="d-flex align-items-center justify-content-between">
            <h4 class="">{{ __("Manage Wishlist") }}</h4>
        </div>

        <div class="table-responsive mt-4">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-end">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($wishlists as $wishlist)
                    <tr>
                        <td valign="middle">
                            <a href="{{ route("product", $wishlist->product->id) }}" class="text-decoration-none text-body">{{ $wishlist->product->name }}</a>
                        </td>
                        <td valign="middle" class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __("Action") }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <form method="POST" action="{{ route("wishlist.destroy", $wishlist->id) }}">
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

        {{ $wishlists->links() }}
    </div>
</div>
@endsection
