@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __("Register") }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route("register") }}">
                            @csrf

                            <div class="">
                                <label for="name">{{ __("Name") }}</label>
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control @error("name") is-invalid @enderror"
                                    name="name"
                                    value="{{ old("name") }}"
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
                                    value="{{ old("username") }}"
                                    required
                                    autocomplete="username"
                                    autofocus
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
                                    value="{{ old("phone") }}"
                                    required
                                    autocomplete="phone"
                                    autofocus
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
                                    value="{{ old("email") }}"
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
                                <label for="password">{{ __("Password") }}</label>
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error("password") is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                />
                                @error("password")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <label for="password-confirm">{{ __("Confirm Password") }}</label>
                                <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                />
                            </div>

                            <div class="mt-3 text-center">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Register") }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
