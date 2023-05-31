@extends("admin.layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <h4 class="">{{ __("Manage Admin") }}</h4>

            <div class="mt-4">
                <form method="POST" action="{{ route("admin.update", $admin->id) }}">
                    @csrf
                    @method("PUT")

                    <div class="">
                        <label for="name">{{ __("Name") }}</label>
                        <input
                            id="name"
                            type="text"
                            class="form-control @error("name") is-invalid @enderror"
                            name="name"
                            value="{{ old("name", $admin->name) }}"
                            required
                            autocomplete="name"
                            autofocus
                        />
                        @error("name")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="username">{{ __("Username") }}</label>
                        <input
                            id="username"
                            type="text"
                            class="form-control @error("username") is-invalid @enderror"
                            name="username"
                            value="{{ old("username", $admin->username) }}"
                            required
                            autocomplete="username"
                        />
                        @error("username")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="password">{{ __("Password") }}</label>
                        <input
                            id="password"
                            type="password"
                            class="form-control @error("password") is-invalid @enderror"
                            name="password"
                            autocomplete="new-password"
                        />
                        @error("password")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="confirm-password">{{ __("Confirm Password") }}</label>
                        <input
                            id="confirm-password"
                            type="password"
                            class="form-control @error("confirm_password") is-invalid @enderror"
                            name="confirm_password"
                            autocomplete="new-password"
                        />
                        @error("confirm_password")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route("admin.index") }}" class="btn btn-secondary">
                            {{ __("Cancel") }}
                        </a>
                        <button type="submit" class="btn btn-primary ms-3">
                            {{ __("Edit") }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
