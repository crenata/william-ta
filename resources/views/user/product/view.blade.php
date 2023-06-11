@extends("layouts.app")

@section("content")
<div class="container">
    <div class="">
        <h3 class="m-0 text-center fw-bold">All Products</h3>

        <div class="row mt-3">
            <div class="col-12 col-md-3">
                <label for="categoryId">{{ __("Category") }}</label>
                <select
                    id="categoryId"
                    type="text"
                    class="form-select"
                    name="categoryId"
                    autocomplete="categoryId"
                    onchange="location = this.options[this.selectedIndex].value"
                >
                    <option value="{{ route("products") }}">Choose Category</option>
                    @foreach($categories as $category)
                        <option value="{{ route("products.category", $category->id) }}" {{ $category->id === old("categoryId", $categoryId) ? "selected" : "" }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-4">
            @foreach($products as $key => $product)
                <div class="col-12 col-md-3">
                    <a href="{{ route("product", $product->id) }}" class="card text-decoration-none text-body">
                        <img src="{{ $product->images[0]->image }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="m-0 {{ empty($product->offer_price) ? "" : "text-decoration-line-through" }}">Rp{{ number_format($product->price) }}</p>
                            <p class="m-0 {{ empty($product->offer_price) ? "d-none" : "" }}">Rp{{ number_format($product->offer_price) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    </div>
</div>
@endsection
