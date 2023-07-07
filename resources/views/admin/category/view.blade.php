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
            <h4 class="">{{ __("Manage Category") }}</h4>
            <a class="btn btn-sm btn-success" href="{{ route("category.create") }}">
                {{ __("Add") }}
            </a>
        </div>

        <div class="table-responsive mt-4" style="height: 75vh;">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Can Custom?</th>
                    <th class="text-end">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td valign="middle">{{ $category->name }}</td>
                        <td valign="middle">{{ $category->image }}</td>
                        <td valign="middle">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="can_custom"
                                id="can_custom"
                                {{ $category->can_custom ? "checked" : "" }}
                            />
                        </td>
                        <td valign="middle" class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-warning dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __("Action") }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route("category.edit", $category->id) }}">{{ __("Edit") }}</a></li>
                                    <form method="POST" action="{{ route("category.destroy", $category->id) }}">
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

        {{ $categories->links() }}
    </div>
</div>
@endsection
