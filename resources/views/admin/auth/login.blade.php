@extends("admin.layouts.app")

@section("content")
<div class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
        <h2 class="text-center fw-bold">{{ __("LOG IN ADMIN") }}</h2>
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <!-- Email input -->
          <div class="form-outline mb-4">
          <form method="POST" action="{{ route("admin.login") }}">
                @csrf
                            <input
                                id="username"
                                type="text"
                                class="form-control @error("username") is-invalid @enderror"
                                name="username"
                                value="{{ old("username") }}"
                                required
                                autocomplete="username"
                                autofocus
                                placeholder="Username"
                            />
                            @error("username")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
          </div>

          <!-- Password input -->
          <div class="form-outline mb-4">
                            <input
                                id="password"
                                type="password"
                                class="form-control @error("password") is-invalid @enderror"
                                name="password"
                                required
                                autocomplete="current-password"
                                placeholder="Password"
                            />
                            @error("password")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
          </div>

          <div class="form-check mt-3">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="remember"
                                id="remember" {{ old("remember") ? "checked" : "" }}
                            />
                            <label class="form-check-label" for="remember">{{ __("Remember Me") }}</label>
            </div>
            <div class="mt-3">
                            <button type="submit" class="btn btn-success">{{ __("Log in") }}</button>
            </div>
            <div class="mt-4">
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
@endsection
