@extends("admin.layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <h3 class="text-center fw-bold">{{ __("Edit Category") }}</h3>

            <div class="mt-4">
                <form method="POST" action="{{ route("category.update", $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="">
                        <label for="name">{{ __("Name") }}</label>
                        <input
                            id="name"
                            type="text"
                            class="form-control @error("name") is-invalid @enderror"
                            name="name"
                            value="{{ old("name", $category->name) }}"
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
                            type="text"
                            class="form-control @error("image") is-invalid @enderror"
                            name="image"
                            value="{{ old("image", $category->image) }}"
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

                    <div class="form-check mt-3">
                        <input
                            class="form-check-input @error("can_custom") is-invalid @enderror"
                            type="checkbox"
                            name="can_custom"
                            id="can_custom" {{ old("can_custom", $category->can_custom) ? "checked" : "" }}
                        />
                        <label class="form-check-label" for="can_custom">{{ __("Can Custom") }}?</label>
                        @error("can_custom")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route("category.index") }}" class="btn btn-danger">
                            {{ __("Cancel") }}
                        </a>
                        <button type="submit" class="btn btn-success ms-3">
                            {{ __("Edit") }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection
