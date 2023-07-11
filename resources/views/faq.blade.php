@extends("layouts.app")

@section("content")
<div class="img-wrap">
    <img src="{{ asset("faq.jpg") }}" alt="Image" class="img-fluid">
</div>
<br>
    <div class="container">
        <div class="accordion mt-4" id="accordionFaq">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <font size="5">Bagaimana cara melacak pesanan?</font>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        <li><font size="4">Untuk melacak pesanan anda dapat klik logo user di sebelah kanan atas -> klik "order" -> klik "action" pada pesanan yang ingin ada lihat -> klik "track"</li>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <font size="5">Bagaimana cara memesan kustom?</font>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        <p class="m-0"><font size="4">Untuk memesan kustom ada 2 cara :</font></p>
                        <ul class="m-0">
                            <li><font size="4">Anda dapat menghubungi kami langsung melalui Whatsapp kami.</font></li>
                            <li><font size="4">Atau, Anda dapat klik halaman custom -> isi form pemesanan custom -> pihak Vijipi Furniture akan menghubungi anda untuk diskusi lebih lanjut</font></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <font size="5">Apa saja jenis metode pembayaran?</font>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        <li><font size="4">Metode pembayaran yang tersedia di website kami untuk saat ini adalah Bank Mandiri</font></li>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <font size="5">Pesanan saya sudah sampai namun rusak saat pengiriman, apa yang harus saya lakukan?</font>
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        <li><font size="4">Anda dapat mengisi form di klik order -> klik action pada pesanan -> klik return. Untuk pengembalian maksimal 30 hari kerja semenjak form anda terkirim</font></li>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <font size="5">Berapa harga ongkos kirim?</font>
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        <li><font size="4">Harga ongkos kirim berbeda-beda tergantung dari lokasi pengiriman anda. Anda dapat mengecek harga ongkir dengan cara klik salah satu produk -> masukkan lokasi anda untuk melihat harga ongkir</font></li>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <font size="5">Apakah bisa Cash on Delivery (COD)?</font>
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        <li><font size="4">Untuk saat ini kami belum menerima COD.</font></li>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    <font size="5">Kapan pesanan saya bisa diantar?</font>
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        <li><font size="4">Untuk pemesanan produk jadi (bukan custom) akan diantar dalam waktu maksimal 10 hari kerja, namun untuk pemesanan custom bervariasi tergantung pesanan.</font></li>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    <font size="5">Area apa saja yang tersedia untuk pengiriman?</font>
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        <li><font size="4">Untuk saat ini area yang tersedia yaitu sekitar JABODETABEK, beberapa area di Banten, dan beberapa area di Sukabumi.</font></li>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                    <font size="5">Apakah Vijipi Furniture dapat menerbitkan kuitansi?</font>
                    </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                       <li><font size="4">Untuk kuitansi akan diberikan secara online melalui email anda dan kuitansi fisik akan diberikan bersamaan dengan barang pesanan anda.</font></li>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
