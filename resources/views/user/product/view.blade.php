@extends("layouts.app")

@section("content")
<!-- Start Hero Section -->
        <div class="hero">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-5">
						<div class="intro-excerpt">
							<h1>ALL <span class="d-block">{{ empty($category) ? (Route::is("products") ? "PRODUCTS" : "PROMO") : $category->name }}</span></h1>
							<br><br><br><br><br><br>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="hero-img-wrap">
							<img src="{{ asset("sofa4.png") }}" class="img-fluid">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Hero Section -->
<br>
<div class="container">
    <div class="">
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
                        <img src="{{ $product->images[0]->image }}" class="card-img-top" style="max-height: 200px" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h4 class="card-title">{{ $product->name }}</h4>
                            <h5 class="m-0 {{ empty($product->offer_price) ? "" : "text-decoration-line-through" }}">Rp {{ number_format($product->price) }}</h5>
                            <h4 class="m-0 {{ empty($product->offer_price) ? "d-none" : "" }}">Rp {{ number_format($product->offer_price) }}</h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <br>
        {{ $products->links() }}
    </div>
</div>
@endsection
