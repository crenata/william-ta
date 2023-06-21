@extends("admin.layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <h4 class="">{{ __("Manage City") }}</h4>

            <div class="mt-4">
                <form method="POST" action="{{ route("city.update", $city->id) }}">
                    @csrf
                    @method("PUT")

                    <div class="">
                        <label for="province_id">{{ __("Province") }}</label>
                        <select
                            id="province_id"
                            class="form-select @error("province_id") is-invalid @enderror"
                            name="province_id"
                            required
                            autocomplete="province_id"
                            autofocus
                        >
                            <option>Choose Province</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}" {{ $province->id === old("province_id", $city->province_id) ? "selected" : "" }}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                        @error("province_id")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="name">{{ __("Name") }}</label>
                        <input
                            id="name"
                            type="text"
                            class="form-control @error("name") is-invalid @enderror"
                            name="name"
                            value="{{ old("name", $city->name) }}"
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
                        <label for="fee">{{ __("Fee") }}</label>
                        <input
                            id="fee"
                            type="number"
                            class="form-control @error("fee") is-invalid @enderror"
                            name="fee"
                            value="{{ old("fee", $city->fee) }}"
                            required
                            autocomplete="fee"
                            autofocus
                        />
                        @error("fee")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route("city.index") }}" class="btn btn-secondary">
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
