@extends("layouts.app")

@section("content")
<br>
<div class="container">
    <div class="">
    <h2 class="m-0 text-center fw-bold">ALL {{ empty($category) ? (Route::is("products") ? "PRODUCT" : "PROMO") : $category->name }}</h2>
        <div class="row mt-3">
            <div class="col-12 col-md-3">
                <label for="categoryId"><font size="4">{{ __("Category") }}</font></label>
                <select
                    id="categoryId"
                    class="form-select"
                    name="categoryId"
                    autocomplete="categoryId"
                    onchange="location = this.options[this.selectedIndex].value"
                >
                    <option value="{{ route(Route::is("products") || Route::is("products.category") ? "products" : "offers") }}">Choose Category</option>
                    @foreach($categories as $category)
                        <option value="{{ route((Route::is("products") || Route::is("products.category") ? "products" : "offers") . ".category", $category->id) }}" {{ $category->id === old("categoryId", $categoryId) ? "selected" : "" }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-4">
            @foreach($products as $key => $product)
                <div class="col-12 col-md-3 {{ $key > 0 ? "mt-3 mt-md-0" : "" }}">
                    <a href="{{ route("product", $product->id) }}" class="card text-decoration-none text-body">
                        <img src="{{ $product->images[0]->image }}" class="card-img-top" alt="{{ $product->name }}" width="250px" height="250px">
                        <div class="card-body">
                            <h3 class="card-title">{{ $product->name }}</h3>
                            <h5 class="{{ $product->is_gold || !empty($product->offer_price) ? "text-decoration-line-through" : "" }}">Rp {{ number_format($product->price) }}</h5>
                            <h4 class="m-0 fw-semibold {{ empty($product->offer_price) ? "d-none" : ($product->is_gold ? "text-decoration-line-through" : "") }}">Rp{{ number_format($product->offer_price) }}</h4>
                            <h4 class="m-0 fw-semibold {{ $product->is_gold ? "" : "d-none" }}">Rp{{ number_format($product->gold_price) }}</h4>
                            <div class="d-flex align-items-center">
                                @foreach(range(1, 5) as $rating)
                                    @if($rating <= (int) $product->reviews()->avg("rating"))
                                        <i class="fa-solid fa-star"></i>
                                    @else
                                        <i class="fa-regular fa-star"></i>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </a>
                    <br>
                </div>
            @endforeach
        </div>
        <br>
        {{ $products->links() }}
    </div>
</div>
@endsection
