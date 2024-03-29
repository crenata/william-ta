@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __("Confirm Password") }}</div>

                    <div class="card-body">
                        {{ __("Please confirm your password before continuing.") }}

                        <form method="POST" action="{{ route("password.confirm") }}">
                            @csrf

                            <div class="">
                                <label for="password">{{ __("Password") }}</label>
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error("password") is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                />
                                @error("password")
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __("Confirm Password") }}
                                </button>
                                @if (Route::has("password.request"))
                                    <a class="btn btn-link" href="{{ route("password.request") }}">
                                        {{ __("Forgot Your Password?") }}
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
