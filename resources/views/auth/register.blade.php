@extends("layouts.app")

@section("content")
<div class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
        <h2 class="text-center fw-bold">{{ __("REGISTER") }}</h2>
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <div class="form-outline mb-4">
            <form method="POST" action="{{ route("register") }}">
                @csrf
                                <input
                                    id="name"
                                    type="text"
                                    class="form-control @error("name") is-invalid @enderror"
                                    name="name"
                                    value="{{ old("name") }}"
                                    required
                                    autocomplete="name"
                                    autofocus
                                    placeholder="Name"
                                />
                                @error("name")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
          </div>

          <div class="form-outline mb-4">
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

          <div class="form-outline mb-4">
                                <input
                                    id="phone"
                                    type="tel"
                                    class="form-control @error("phone") is-invalid @enderror"
                                    name="phone"
                                    value="{{ old("phone") }}"
                                    required
                                    autocomplete="phone"
                                    autofocus
                                    placeholder="Phone Number"
                                />
                                @error("phone")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
          </div>

          <div class="form-outline mb-4">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control @error("email") is-invalid @enderror"
                                    name="email"
                                    value="{{ old("email") }}"
                                    required
                                    autocomplete="email"
                                    placeholder="Email Address"
                                />
                                @error("email")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
          </div>

          <div class="form-outline mb-4">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control @error("password") is-invalid @enderror"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Password"
                                />
                                @error("password")
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
          </div>

          <div class="form-outline mb-4">
          <input
                                    id="password-confirm"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Confirm Password"
                                />
          </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-success">
                    {{ __("Register") }}
                </button>   
            </div>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection
