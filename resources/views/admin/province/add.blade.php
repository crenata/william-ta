@extends("admin.layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <h4 class="">{{ __("Manage Province") }}</h4>

            <div class="mt-4">
                <form method="POST" action="{{ route("province.store") }}">
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

                    <div class="mt-3 text-center">
                        <a href="{{ route("province.index") }}" class="btn btn-secondary">
                            {{ __("Cancel") }}
                        </a>
                        <button type="submit" class="btn btn-primary ms-3">
                            {{ __("Add") }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
