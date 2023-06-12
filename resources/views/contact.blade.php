@extends("layouts.app")

@section("content")
    <div class="container">
        <h3 class="m-0 text-center fw-bold">Contact Us</h3>
        <div class="mt-4 text-center">
            <img src="{{ asset("logo.png") }}" alt="Logo">
            <h5 class="mt-3 mb-0">Kami senang menerima pesanan dari anda. Silahkan menghubungi kami!</h5>
            <table class="table table-borderless mt-4">
                <tbody>
                <tr>
                    <td class="text-end">Whatsapp</td>
                    <td style="width: 2px">:</td>
                    <td class="text-start"><a href="https://wa.me/6285217906821">0852-1790-6821</a></td>
                </tr>
                <tr>
                    <td class="text-end">Alamat</td>
                    <td style="width: 2px">:</td>
                    <td class="text-start">Samping Divisi I Kostrad Blok G 128 RT.04 RW.01 Kel. Kalibaru, Kec. Cilodong, Kota Depok, Jawa Barat</td>
                </tr>
                <tr>
                    <td class="text-end">Instagram</td>
                    <td style="width: 2px">:</td>
                    <td class="text-start"><a href="https://www.instagram.com/vijipifurniture">@vijipifurniture</a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
