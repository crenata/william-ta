<?php

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("answer_id");
            $table->longText("name");
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("answer_id")->references("id")->on("answers")->onDelete("cascade");
        });

        foreach (
            [
                [
                    "answer" => "Hallo! Selamat datang di Vijipi Furniture! Ada yang bisa kami bantu?",
                    "questions" => [
                        "hi",
                        "hello",
                        "hai",
                        "halo",
                        "hallo"
                    ]
                ],
                [
                    "answer" => "Untuk melihat akun : klik logo user sebelah kanan atas -> klik \"my account\" / akun saya",
                    "questions" => [
                        "bagaimana cara melihat akun saya",
                        "akun",
                        "cara melihat akun saya",
                        "cara melihat akun",
                        "akun saya"
                    ]
                ],
                [
                    "answer" => "Untuk melihat status pesanan : Klik logo user di sebelah kanan atas -> klik \"my order status\" / pesanan saya",
                    "questions" => [
                        "bagaimana cara melacak status pesanan",
                        "melacak status",
                        "melacak status pesanan",
                        "melacak pesanan",
                        "status pesanan"
                    ]
                ],
                [
                    "answer" => "Anda dapat menghubungi kami secara langsung melalui Whatsapp : 085217906821",
                    "questions" => [
                        "apa saja kontak yang dapat dihubungi",
                        "kontak",
                        "kontak vijipi furniture",
                        "nomor",
                        "whatsapp"
                    ]
                ],
                [
                    "answer" => "Metode pembayaran yang tersedia di website kami untuk saat ini adalah Bank Mandiri",
                    "questions" => [
                        "apa saja jenis metode pembayaran",
                        "jenis pembayaran",
                        "metode pembayaran",
                        "pembayaran",
                        "bayar"
                    ]
                ],
                [
                    "answer" => "Untuk memesan kustom ada 2 cara : Anda dapat menghubungi kami langsung melalui Whatsapp kami Atau Anda dapat klik halaman custom -> isi form pemesanan custom -> pihak Vijipi Furniture akan menghubungi anda untuk diskusi lebih lanjut",
                    "questions" => [
                        "bagaimana cara memesan custom",
                        "cara beli custom",
                        "custom",
                        "pesan custom",
                        "kustom"
                    ]
                ],
                [
                    "answer" => "Jika anda ingin mengembalikan barang, silahkan baca terlebih dahulu kebijakan pengembalian (Return Policy). Jika sudah maka anda dapat mengajukan pengembalian dengan cara : Klik logo user di sebelah kanan atas -> klik pesanan saya -> klik ajukan pengembalian pada barang yang anda ingin kembalikan. Untuk pengembalian maksimal 30 hari kerja semenjak form anda terkirim",
                    "questions" => [
                        "bagaimana cara mengembalikan barang",
                        "cara mengembalikan produk",
                        "pengembalian barang",
                        "pengembalian produk"
                    ]
                ],
                [
                    "answer" => "Harga ongkos kirim berbeda-beda tergantung dari lokasi pengiriman anda. Anda dapat mengecek harga ongkir dengan cara klik salah satu produk -> masukkan lokasi anda untuk melihat harga ongkir",
                    "questions" => [
                        "berapa harga ongkos kirim",
                        "harga ongkos kirim",
                        "ongkos kirim",
                        "ongkir",
                        "harga ongkir"
                    ]
                ],
                [
                    "answer" => "Untuk saat ini kami belum menerima COD",
                    "questions" => [
                        "apakah bisa cash on delivery",
                        "apakah bisa cod",
                        "cod",
                        "cash on delivery"
                    ]
                ],
                [
                    "answer" => "Untuk pemesanan secara langsung (bukan custom) akan diantar dalam waktu maksimal 10 hari kerja, namun untuk pemesanan custom bervariasi tergantung pesanan",
                    "questions" => [
                        "kapan pesanan saya bisa diantar",
                        "kapan produk saya bisa diantar",
                        "kapan barang saya bisa diantar",
                        "waktu pengiriman",
                        "pengiriman barang",
                        "pengiriman pesanan",
                        "pengiriman produk",
                        "pengiriman"
                    ]
                ],
                [
                    "answer" => "Untuk saat ini area yang tersedia yaitu sekitar JABODETABEK, beberapa area di Banten, dan beberapa area di Sukabumi",
                    "questions" => [
                        "area apa saja yang tersedia untuk pengiriman",
                        "area pengiriman",
                        "bisa dikirim kemana saja"
                    ]
                ],
                [
                    "answer" => "Untuk kuitansi akan diberikan bersamaan dengan barang pesanan anda",
                    "questions" => [
                        "apakah vijipi furniture dapat menerbitkan kuitansi",
                        "kuitansi",
                        "kwitansi",
                        "apakah vijipi furniture dapat menerbitkan kwitansi"
                    ]
                ],
                [
                    "answer" => "Untuk saat ini kami memiliki Instagram yaitu : vijipifurniture",
                    "questions" => [
                        "apa social media vijipi furniture",
                        "social media",
                        "sosial media",
                        "media sosial",
                        "medsos",
                        "instagram",
                        "sosmed",
                        "ig"
                    ]
                ],
                [
                    "answer" => "Alamat Workshop kami berada di Samping Divisi I Kostrad Blok G 128 RT.04 RW.01 Kel. Kalibaru, Kec. Cilodong, Kota Depok, Jawa Barat",
                    "questions" => [
                        "dimana lokasi vijipi furniture",
                        "lokasi workshop",
                        "lokasi",
                        "workshop",
                        "letak vijipi furniture",
                        "letak",
                        "posisi",
                        "posisi vijipi furniture"
                    ]
                ]
            ] as $data
        ) {
            $answer = Answer::create([
                "name" => $data["answer"]
            ]);
            foreach ($data["questions"] as $question) {
                Question::create([
                    "answer_id" => $answer->id,
                    "name" => $question
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('questions');
    }
};
