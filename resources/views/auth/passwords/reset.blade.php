@extends("layouts.app")

@section("content")
<div class="vh-100">
  <div class="container py-5 h-100">
    <div class="row d-flex align-items-center justify-content-center h-100">
        <h2 class="text-center fw-bold">{{ __("RESET PASSWORD") }}</h2>
      <div class="col-md-8 col-lg-7 col-xl-6">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
          class="img-fluid" alt="Phone image">
      </div>
      <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                <div class="form-outline mb-4">
                        <form method="POST" action="{{ route("password.update") }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">
                                        <input
                                            id="email"
                                            type="email"
                                            class="form-control @error("email") is-invalid @enderror"
                                            name="email"
                                            value="{{ $email ?? old("email") }}"
                                            required
                                            autocomplete="email"
                                            autofocus
                                            placeholder="Email"
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
                                            placeholder="New Password"
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
                                            placeholder="Confirm New Password"
                                        />
                </div>

                <div class="mt-3 text-center">
                    <button type="submit" class="btn btn-success">
                        {{ __("Reset Password") }}
                    </button>
                </div>

          
            </form>
        </div>
    </div>
  </div>
</div>
@endsection
