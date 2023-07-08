@extends("layouts.app")

@section("content")
<div class="img-wrap">
    <img src="{{ asset("contact.jpg") }}" alt="Image" class="img-fluid">
</div>
    <div class="container">
        <div class="mt-4 text-center">
        <img align="middle" src="{{ asset("logo.png") }}" alt="Logo" width="350">
            <h3 class="mt-3 mb-0">Kami senang menerima pesanan dari anda. Silahkan menghubungi kami!</h3>
            <br>
            <div class="table-responsive mt-4" style="height: 75vh;">
                <table class="table table-borderless">
                    <tbody>
                    <tr>
                        <td class="text-end"><h4>Whatsapp</h4></td>
                        <td style="width: 2px"><h4>:</h4></td>
                        <td class="text-start"><h4><a href="https://wa.me/6285217906821">0852-1790-6821</a></h4></td>
                    </tr>
                    <tr>
                        <td class="text-end"><h4>Alamat Workshop</h4></td>
                        <td style="width: 2px"><h4>:</h4></td>
                        <td class="text-start"><h4>Samping Divisi I Kostrad Blok G 128 RT.04 RW.01 Kel. Kalibaru, Kec. Cilodong, Kota Depok, Jawa Barat</h4></td>
                    </tr>
                    <tr>
                        <td class="text-end"><h4>Instagram</h4></td>
                        <td style="width: 2px"><h4>:</h4></td>
                        <td class="text-start"><h4><a href="https://www.instagram.com/vijipifurniture">@vijipifurniture</a></h4></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
