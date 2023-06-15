@extends("layouts.app")

@section("content")
<div class="container">
    <div class="">
        @if (session("status"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session("status") }}
                <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex align-items-center justify-content-between">
            <h4 class="">{{ __("Transactions") }}</h4>
        </div>

        <div class="table-responsive mt-4">
            <table class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Invoice Number</th>
                    <th class="text-end">Quantity</th>
                    <th class="text-end">Gross Amount</th>
                    <th>Status</th>
                    <th>Purchased At</th>
                    <th class="text-end">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td valign="middle">
                            <a href="{{ route("product", $transaction->product->id) }}" class="text-decoration-none text-body">{{ $transaction->product->name }}</a>
                        </td>
                        <td valign="middle">{{ $transaction->invoice_number }}</td>
                        <td valign="middle" class="text-end">{{ number_format($transaction->quantity) }}</td>
                        <td valign="middle" class="text-end">Rp{{ number_format($transaction->gross_amount) }}</td>
                        <td valign="middle">{{ ucwords(str_replace("_", " ", strtolower(\App\Constants\MidtransStatusConstant::getNameByValue($transaction->latestHistory->status)))) }}</td>
                        <td valign="middle">{{ $transaction->created_at }}</td>
                        <td valign="middle" class="text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __("Action") }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a
                                            class="dropdown-item transaction-detail"
                                            href="javascript:void(0)"
                                            data-bs-toggle="modal"
                                            data-bs-target="#transaction-detail-modal"
                                            data-tx="{{ $transaction }}"
                                        >{{ __("Track") }}</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $transactions->links() }}

        <div class="modal fade" id="transaction-detail-modal" tabindex="-1" aria-labelledby="transaction-detail-modal-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="transaction-detail-modal-label">Modal title</h1>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody id="transaction-detail-tracking"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let title = document.getElementById("transaction-detail-modal-label");
        let tracking = document.getElementById("transaction-detail-tracking");
        let transactions = document.getElementsByClassName("transaction-detail");
        const getStatus = status => {
            switch (status) {
                case {{ \App\Constants\MidtransStatusConstant::SETTLEMENT }}:
                    return "Pembayaran telah diterima";
                case {{ \App\Constants\MidtransStatusConstant::DENY }}:
                    return "Pembayaran ditolak";
                case {{ \App\Constants\MidtransStatusConstant::PENDING }}:
                    return "Pesanan dibuat dan menunggu pembayaran";
                case {{ \App\Constants\MidtransStatusConstant::CANCEL }}:
                    return "Pembayaran dibatalkan";
                case {{ \App\Constants\MidtransStatusConstant::REFUND }}:
                    return "Pembayaran telah direfund";
                case {{ \App\Constants\MidtransStatusConstant::PARTIAL_REFUND }}:
                    return "Pembayaran telah direfund sebagian";
                case {{ \App\Constants\MidtransStatusConstant::EXPIRE }}:
                    return "Pembayaran telah expired";
                case {{ \App\Constants\MidtransStatusConstant::FAILURE }}:
                    return "Pembayaran telah gagal";
                case {{ \App\Constants\MidtransStatusConstant::PROCESSED }}:
                    return "Pesanan diproses";
                case {{ \App\Constants\MidtransStatusConstant::DELIVERY }}:
                    return "Pesanan sedang diantar";
                case {{ \App\Constants\MidtransStatusConstant::ARRIVED }}:
                    return "Pesanan telah sampai";
                case {{ \App\Constants\MidtransStatusConstant::REQUEST_RETURN }}:
                    return "Mengajukan pengembalian";
                case {{ \App\Constants\MidtransStatusConstant::RETURN_REJECTED }}:
                    return "Pengajuan pengembalian ditolak";
                case {{ \App\Constants\MidtransStatusConstant::PROCESS_RETURN }}:
                    return "Pengajuan pengembalian diproses";
                case {{ \App\Constants\MidtransStatusConstant::RETURNED }}:
                    return "Pengembalian selesai";
                default:
                    return "Status tidak diketahui";
            }
        };
        for (let i = 0; i < transactions.length; i++) {
            let tx = transactions[i];
            tx.onclick = function () {
                let data = JSON.parse(this.getAttribute("data-tx"));
                title.textContent = data.name;
                tracking.innerHTML = "";
                data.histories.forEach(value => {
                    tracking.insertAdjacentHTML("afterbegin", `
                        <tr>
                            <td>${new Date(value.created_at).toLocaleString()}</td>
                            <td>${getStatus(value.status)}</td>
                        </tr>
                    `);
                });
            }
        }
    </script>
</div>
@endsection
