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
            <h4 class="">{{ __("Manage Area") }}</h4>
            <a class="btn btn-sm btn-success" href="{{ route("area.create") }}">
                {{ __("Add") }}
            </a>
        </div>

        <div class="table-responsive mt-4" style="height: 75vh;">
            <table class="table">
                <thead>
                <tr>
                    <th>Province</th>
                    <th>City</th>
                    <th>Name</th>
                    <th>Fee</th>
                    <th class="text-end">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($areas as $area)
                    <tr>
                        <td valign="middle">{{ $area->city->province->name }}</td>
                        <td valign="middle">{{ $area->city->name }}</td>
                        <td valign="middle">{{ $area->name }}</td>
                        <td valign="middle">Rp{{ number_format($area->fee) }}</td>
                        <td valign="middle" class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __("Action") }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route("area.edit", $area->id) }}">{{ __("Edit") }}</a></li>
                                    <form method="POST" action="{{ route("area.destroy", $area->id) }}">
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

        {{ $areas->links() }}
    </div>
</div>
@endsection
