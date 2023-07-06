@extends("layouts.app")

@section("content")
<!-- Start Hero Section -->
        <div class="hero">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-5">
						<div class="intro-excerpt">
							<h1>Modern Interior <span clsas="d-block">Design Studio</span></h1>
							<p class="mb-4">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
							<p><a href="{{ route("products") }}" class="btn btn-secondary me-2"><b>Explore</b></a></p>
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
    <div class="container">
        <br>
        <h2 class="m-0 text-center fw-bold">ABOUT US</h2>
        <br>
        <div class="mt-4 text-center">
            <h4 class="mt-3 mb-0 px-5 ">Vijipi Furniture adalah Merk Furniture dan Aksesoris di Indonesia, di mana kami memproduksi produk-produk furniture dan aksesoris yang berkualitas bagi keluarga Indonesia.</h4>
            <br>
            <br>
            <h4 class="mt-3 mb-0 px-5 fw-bold">Kualitas Produk Vijipi Furniture</h4>
            <h4 class="mt-3 mb-0">Produk Vijipi didesain dan dikembangkan oleh tenaga yang berpengalaman dibidangnya sehingga menghasilkan produk berkualitas bagi kebutuhan konsumen.</h4>
            <br>
            <br>
        <h4 class="mt-3 mb-0 fw-bold">Motto Kami</h4>
        <h4 class="mt-1 mb-0">Selalu memberi yang terbaik bagi Customer kami, yaitu memproduksi produk berkualitas dengan desain terkini serta pelayanan yang prima. Kami hadir untuk memenuhi harapan serta impian customer kami menjadi kenyataan dalam mewujudkan rumah idaman.</h4>
        </div>
    </div>
@endsection
