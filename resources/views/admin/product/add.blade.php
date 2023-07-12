@extends("admin.layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-3">
            <h3 class="text-center fw-bold">{{ __("Add Product") }}</h3>

            <div class="mt-4">
                <form method="POST" action="{{ route("product.store") }}" enctype="multipart/form-data">
                    @csrf

                    <div class="">
                        <label for="category_id">{{ __("Category") }}</label>
                        <select
                            id="category_id"
                            class="form-select @error("category_id") is-invalid @enderror"
                            name="category_id"
                            required
                            autocomplete="category_id"
                            autofocus
                        >
                            <option>Choose Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id === old("category_id") ? "selected" : "" }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error("category_id")
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
                        <label for="price">{{ __("Price") }}</label>
                        <input
                            id="price"
                            type="number"
                            class="form-control @error("price") is-invalid @enderror"
                            name="price"
                            value="{{ old("price") }}"
                            required
                            autocomplete="price"
                            autofocus
                        />
                        @error("price")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="offer_price">{{ __("Offer Price") }}</label>
                        <input
                            id="offer_price"
                            type="number"
                            class="form-control @error("offer_price") is-invalid @enderror"
                            name="offer_price"
                            value="{{ old("offer_price") }}"
                            autocomplete="offer_price"
                            autofocus
                        />
                        @error("offer_price")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="description">{{ __("Description") }}</label>
                        <textarea
                            id="description"
                            name="description"
                            autocomplete="description"
                        >{{ old("description") }}</textarea>
                        @error("description")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="stock">{{ __("Stock") }}</label>
                        <input
                            id="stock"
                            type="number"
                            class="form-control @error("stock") is-invalid @enderror"
                            name="stock"
                            value="{{ old("stock") }}"
                            autocomplete="stock"
                            autofocus
                        />
                        @error("stock")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="duration">{{ __("Duration") }}</label>
                        <input
                            id="duration"
                            type="number"
                            class="form-control @error("duration") is-invalid @enderror"
                            name="duration"
                            value="{{ old("duration") }}"
                            required
                            autocomplete="duration"
                            autofocus
                        />
                        @error("duration")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="duration_type">{{ __("Duration Type") }}</label>
                        <input
                            id="duration_type"
                            type="text"
                            class="form-control @error("duration_type") is-invalid @enderror"
                            name="duration_type"
                            value="{{ old("duration_type") }}"
                            required
                            autocomplete="duration_type"
                            autofocus
                        />
                        @error("duration_type")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="start_price">{{ __("Start Price") }}</label>
                        <input
                            id="start_price"
                            type="number"
                            class="form-control @error("start_price") is-invalid @enderror"
                            name="start_price"
                            value="{{ old("start_price") }}"
                            required
                            autocomplete="start_price"
                            autofocus
                        />
                        @error("start_price")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="end_price">{{ __("End Price") }}</label>
                        <input
                            id="end_price"
                            type="number"
                            class="form-control @error("end_price") is-invalid @enderror"
                            name="end_price"
                            value="{{ old("end_price") }}"
                            required
                            autocomplete="end_price"
                            autofocus
                        />
                        @error("end_price")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="images">{{ __("Images") }}</label>
                        <input
                            id="images"
                            type="file"
                            class="form-control @error("images") is-invalid @enderror"
                            name="images[]"
                            value="{{ old("images") }}"
                            required
                            autocomplete="images"
                            accept="image/*"
                            multiple
                        />
                        @error("images")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route("product.index") }}" class="btn btn-danger">
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
        ClassicEditor.create(document.querySelector("#description"));
    </script>
</div>
@endsection
