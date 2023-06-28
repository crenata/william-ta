@extends("layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <h4 class="">{{ __("Manage Address") }}</h4>

            <div class="mt-4">
                <form method="POST" action="{{ route("address.update", $address->id) }}">
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
                            onchange="location = this.options[this.selectedIndex].value"
                        >
                            <option value="{{ route("address.edit", $address->id) }}">Choose Province</option>
                            @foreach($provinces as $province)
                                <option value="{{ route("address.edit", $address->id) }}?province={{ $province->id }}" {{ $province->id === old("province_id", empty($provinceId) ? $address->city->province->id : $provinceId) ? "selected" : "" }}>{{ $province->name }}</option>
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
                                <option value="{{ $city->id }}" {{ $city->id === old("city_id", $address->city_id) ? "selected" : "" }}>{{ $city->name }}</option>
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
                            value="{{ old("name", $address->name) }}"
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
                            value="{{ old("address", $address->address) }}"
                            required
                            autocomplete="address"
                        />
                        @error("address")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route("address.index") }}" class="btn btn-secondary">
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
