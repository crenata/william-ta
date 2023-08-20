@extends("admin.layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <h3 class="text-center fw-bold">{{ __("Add Color") }}</h3>

            <div class="mt-4">
                <form method="POST" action="{{ route("color.store") }}" enctype="multipart/form-data">
                    @csrf

                    <div class="">
                        <label for="material_id">{{ __("Material") }}</label>
                        <select
                            id="material_id"
                            class="form-select @error("material_id") is-invalid @enderror"
                            name="material_id"
                            required
                            autocomplete="material_id"
                            autofocus
                        >
                            <option>Choose Material</option>
                            @foreach($materials as $material)
                                <option value="{{ $material->id }}" {{ $material->id === old("material_id") ? "selected" : "" }}>{{ $material->name }}</option>
                            @endforeach
                        </select>
                        @error("material_id")
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
                        <label for="image">{{ __("Image") }}</label>
                        <input
                            id="image"
                            type="file"
                            class="form-control @error("image") is-invalid @enderror"
                            name="image"
                            value="{{ old("image") }}"
                            required
                            autocomplete="image"
                            accept="image/*"
                        />
                        @error("image")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route("color.index") }}" class="btn btn-danger">
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
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection
