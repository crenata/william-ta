@extends("layouts.app")

@section("content")
<br>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            @if (session("status"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session("status") }}
                    <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <h3 class="fw-bold">{{ __("My Account") }}</h3>

            <div class="mt-4">
                <form method="POST" action="{{ route("account.update", $account->id) }}">
                    @csrf
                    @method("PUT")

                    <div class="">
                        <label for="name">{{ __("Name") }}</label>
                        <input
                            id="name"
                            type="text"
                            class="form-control @error("name") is-invalid @enderror"
                            name="name"
                            value="{{ old("name", $account->name) }}"
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
                            value="{{ old("username", $account->username) }}"
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
                        <label for="phone">{{ __("Phone") }}</label>
                        <input
                            id="phone"
                            type="tel"
                            class="form-control @error("phone") is-invalid @enderror"
                            name="phone"
                            value="{{ old("phone", $account->phone) }}"
                            required
                            autocomplete="phone"
                        />
                        @error("phone")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="email">{{ __("Email Address") }}</label>
                        <input
                            id="email"
                            type="email"
                            class="form-control @error("email") is-invalid @enderror"
                            name="email"
                            value="{{ old("email", $account->email) }}"
                            required
                            autocomplete="email"
                        />
                        @error("email")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="old_password">{{ __("Old Password") }}</label>
                        <input
                            id="old_password"
                            type="password"
                            class="form-control @error("old_password") is-invalid @enderror"
                            name="old_password"
                            autocomplete="new-password"
                        />
                        @error("old_password")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="new_password">{{ __("New Password") }}</label>
                        <input
                            id="new_password"
                            type="password"
                            class="form-control @error("new_password") is-invalid @enderror"
                            name="new_password"
                            autocomplete="new-password"
                        />
                        @error("new_password")
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
                            class="form-control"
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
                        <a href="{{ route("account.index") }}" class="btn btn-danger">
                            {{ __("Cancel") }}
                        </a>
                        <button type="submit" class="btn btn-success ms-3">
                            {{ __("Edit") }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
