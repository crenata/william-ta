@extends("layouts.app")

@section("content")
<img src="{{ asset("about.jpg") }}" alt="Logo" width="100%" height="500">
    <div class="container">
        <br>
        <h2 class="m-0 text-center fw-bold">CONTACT US</h2>
        <br>
        <div class="mt-4 text-center">
            <h4 class="mt-3 mb-0">Kami senang menerima pesanan dari anda. Silahkan menghubungi kami!</h4>
            <br>
            <div class="table-responsive mt-4" style="height: 75vh;">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <td class="text-end"><h5>Whatsapp</h5></td>
                        <td style="width: 2px"><h5>:</h5></td>
                        <td class="text-start"><h5><a href="https://wa.me/6285217906821">0852-1790-6821</a></h5></td>
                    </tr>
                    <tr>
                        <td class="text-end"><h5>Alamat</h5></td>
                        <td style="width: 2px"><h5>:</h5></td>
                        <td class="text-start"><h5>Samping Divisi I Kostrad Blok G 128 RT.04 RW.01 Kel. Kalibaru, Kec. Cilodong, Kota Depok, Jawa Barat</h5></td>
                    </tr>
                    <tr>
                        <td class="text-end"><h5>Instagram</h5></td>
                        <td style="width: 2px"><h5>:</h5></td>
                        <td class="text-start"><h5><a href="https://www.instagram.com/vijipifurniture">@vijipifurniture</a></h5></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
