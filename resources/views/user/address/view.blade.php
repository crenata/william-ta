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
            <h4 class="">{{ __("Manage Address") }}</h4>
            <a class="btn btn-sm btn-primary" href="{{ route("address.create") }}">
                {{ __("Add") }}
            </a>
        </div>

        <table class="table mt-4">
            <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($addresses as $address)
                <tr>
                    <td valign="middle">{{ $address->name }}</td>
                    <td valign="middle">{{ $address->address }}</td>
                    <td valign="middle">
                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __("Action") }}
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route("address.edit", $address->id) }}">{{ __("Edit") }}</a></li>
                                <form method="POST" action="{{ route("address.destroy", $address->id) }}">
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

        {{ $addresses->links() }}
    </div>
</div>
@endsection
