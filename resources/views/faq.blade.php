@extends("layouts.app")

@section("content")
    <div class="container">
        <h3 class="m-0 text-center fw-bold">Frequently Asked Questions</h3>
        <div class="accordion mt-4" id="accordionFaq">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Bagaimana cara melacak pesanan?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        Untuk melacak pesanan anda dapat klik logo user di sebelah kanan atas -> klik status pesanan saya -> klik lacak pesanan
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Bagaimana cara memesan kustom?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        <p class="m-0">Untuk memesan kustom ada 2 cara :</p>
                        <ul class="m-0">
                            <li>Anda dapat menghubungi kami langsung melalui Whatsapp kami.</li>
                            <li>Atau, Anda dapat klik halaman custom -> isi form pemesanan custom -> pihak Vijipi Furniture akan menghubungi anda untuk diskusi lebih lanjut</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Apa saja jenis metode pembayaran?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        Metode pembayaran yang tersedia di website kami untuk saat ini adalah Bank Mandiri
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        Pesanan saya sudah sampai namun rusak saat pengiriman, apa yang harus saya lakukan?
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        Anda dapat mengisi form di status pesanan saya -> ajukan pengembalian. Untuk pengembalian maksimal 30 hari kerja semenjak form anda terkirim
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        Berapa harga ongkos kirim?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        Harga ongkos kirim berbeda-beda tergantung dari lokasi pengiriman anda. Anda dapat mengecek harga ongkir dengan cara klik salah satu produk -> masukkan lokasi anda untuk melihat harga ongkir
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        Apakah bisa Cash on Delivery (COD)?
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        Untuk saat ini kami belum menerima COD.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        Kapan pesanan saya bisa diantar?
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        Untuk pemesanan secara langsung (bukan custom) akan diantar dalam waktu maksimal 10 hari kerja, namun untuk pemesanan custom bervariasi tergantung pesanan.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        Area apa saja yang tersedia untuk pengiriman?
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        Untuk saat ini area yang tersedia yaitu sekitar JABODETABEK, beberapa area di Banten, dan beberapa area di Sukabumi.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        Apakah Vijipi Furniture dapat menerbitkan kuitansi?
                    </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#accordionFaq">
                    <div class="accordion-body">
                        Untuk kuitansi akan diberikan bersamaan dengan barang pesanan anda.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
