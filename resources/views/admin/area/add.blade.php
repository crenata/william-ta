@extends("admin.layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <h4 class="">{{ __("Manage Area") }}</h4>

            <div class="mt-4">
                <form method="POST" action="{{ route("area.store") }}">
                    @csrf

                    <div class="">
                        <label for="province_id">{{ __("Province") }}</label>
                        <select
                            id="province_id"
                            class="form-select @error("province_id") is-invalid @enderror"
                            name="province_id"
                            required
                            autocomplete="province_id"
                            autofocus
                            onchange="location = this.options[this.selectedIndex].value"
                        >
                            <option value="{{ route("area.create") }}">Choose Province</option>
                            @foreach($provinces as $province)
                                <option value="{{ route("area.create", ["province" => $province->id]) }}" {{ $province->id === old("province_id", $provinceId) ? "selected" : "" }}>{{ $province->name }}</option>
                            @endforeach
                        </select>
                        @error("province_id")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="city_id">{{ __("City") }}</label>
                        <select
                            id="city_id"
                            class="form-select @error("city_id") is-invalid @enderror"
                            name="city_id"
                            required
                            autocomplete="city_id"
                            autofocus
                        >
                            <option>{{ empty($cities) ? "Choose Province First" : "Choose City" }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ $city->id === old("city_id") ? "selected" : "" }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error("city_id")
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
                        <label for="fee">{{ __("Fee") }}</label>
                        <input
                            id="fee"
                            type="number"
                            class="form-control @error("fee") is-invalid @enderror"
                            name="fee"
                            value="{{ old("fee") }}"
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
                        <a href="{{ route("area.index") }}" class="btn btn-secondary">
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
