@extends("layouts.app")

@section("content")
<!-- Start Hero Section -->
        <div class="hero">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-5">
						<div class="intro-excerpt">
							<h1>Return <span class="d-block">Policy</span></h1>
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
        <ul class="mt-4">
            <li>
                <h3 class="m-0">Barang yang dipesan tidak sesuai</h3>
                <br>
                <h4 class="m-0">Jika produk yang anda pesan tidak sesuai dengan produk yang anda terima,maka anda dapat mengajukan pengembalian barang dengan syarat dan ketentuan sebagai berikut :</h4>
                <br>
                <ol>
                    <h5>
                    <li>Pengajuan pengembalian barang dilakukan maksimal 30 hari kerja setelah produk diterima oleh pelanggan.</li>
                    <li>Barang harus dalam kondisi orisinil dan prima. Kami akan melakukan analisa terlebih dahulu untuk menyatakan bahwa barang layak untuk dikembalikan.</li>
                    <li>Mengisi form pengembalian barang dengan menyertakan  bukti gambar dan video barang.</li>
                    <li>Setelah mengisi form, kami akan menghubungi anda untuk lebih lanjut.</li>
                    </h5>
                </ol>
            </li>
            <br>
            <li class="mt-2">
                <h3 class="m-0">Barang yang di pesan mengalami kerusakan saat pengiriman</h3>
                <br>
                <h4 class="m-0">Jika produk yang anda pesan mengalami kerusakan saat pengiriman,maka anda dapat mengajukan pengembalian barang dengan syarat dan ketentuan sebagai berikut :</h4>
                <br>
                <ol>
                    <h5>
                    <li>Pengajuan pengembalian barang dilakukan maksimal 30 hari kerja setelah produk diterima oleh pelanggan.</li>
                    <li>Mengisi form pengembalian barang dengan menyertakan  bukti gambar dan video barang.</li>
                    <li>Setelah mengisi form, kami akan menghubungi anda untuk lebih lanjut.</li>
                    </h5>
                </ol>
            </li>
        </ul>
    </div>
@endsection
