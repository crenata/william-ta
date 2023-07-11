@extends("layouts.app")

@section("content")
<br>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <h3 class="text-center fw-bold">{{ __("Add Address") }}</h3>

            <div class="mt-4">
                <form method="POST" action="{{ route("address.store") }}">
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
                            <option value="{{ route("address.create") }}">Choose Province</option>
                            @foreach($provinces as $province)
                                <option value="{{ route("address.create", ["province" => $province->id]) }}" {{ $province->id === old("province_id", $provinceId) ? "selected" : "" }}>{{ $province->name }}</option>
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
                            onchange="location = this.options[this.selectedIndex].value"
                        >
                            <option>{{ empty($cities) ? "Choose Province First" : "Choose City" }}</option>
                            @foreach($cities as $city)
                                <option value="{{ url()->full() }}&city={{ $city->id }}" {{ $city->id === old("city_id", $cityId) ? "selected" : "" }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error("city_id")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="area_id">{{ __("Area") }}</label>
                        <select
                            id="area_id"
                            class="form-select @error("area_id") is-invalid @enderror"
                            name="area_id"
                            required
                            autocomplete="area_id"
                            autofocus
                        >
                            <option>{{ empty($areas) ? "Choose City First" : "Choose Area" }}</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->id }}" {{ $area->id === old("area_id") ? "selected" : "" }}>{{ $area->name }}</option>
                            @endforeach
                        </select>
                        @error("area_id")
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
                        <label for="address">{{ __("Address") }}</label>
                        <input
                            id="address"
                            type="text"
                            class="form-control @error("address") is-invalid @enderror"
                            name="address"
                            value="{{ old("address") }}"
                            required
                            autocomplete="address"
                        />
                        @error("address")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="map" class="w-100 mt-3" style="height: 400px;"></div>

                    <input
                        id="latitude"
                        type="text"
                        class="form-control d-none"
                        name="latitude"
                        value=""
                        required
                        autocomplete="latitude"
                    />

                    <input
                        id="longitude"
                        type="text"
                        class="form-control d-none"
                        name="longitude"
                        value=""
                        required
                        autocomplete="longitude"
                    />

                    <div class="mt-3 text-center">
                        <a href="{{ route("address.index") }}" class="btn btn-danger">
                            {{ __("Cancel") }}
                        </a>
                        <button type="submit" class="btn btn-success ms-3">
                            {{ __("Add") }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $("#map").locationpicker({
                location: {
                    latitude: -6.177007,
                    longitude: 106.827115
                },
                radius: 0,
                inputBinding: {
                    latitudeInput: $("#latitude"),
                    longitudeInput: $("#longitude")
                },
                enableAutocomplete: true
            });
        });
    </script>
</div>
@endsection
