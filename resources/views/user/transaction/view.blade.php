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

        <br>
        <div class="d-flex align-items-center justify-content-between">
            <h3 class="fw-bold">{{ __("Transactions") }}</h3>
        </div>

        <div class="table-responsive mt-4" style="height: 75vh;">
            <table class="table">
                <thead>
                <tr>
                    <th><font size="3">Address</font></th>
                    <th><font size="3">Name</font></th>
                    <th><font size="3">Invoice Number</font></th>
                    <th class="text-end"><font size="3">Quantity</font></th>
                    <th class="text-end"><font size="3">Gross Amount</font></th>
                    <th><font size="3">Status</font></th>
                    <th><font size="3">Purchased At</font></th>
                    <th class="text-end"><font size="3">Action</font></th>
                </tr>
                </thead>
                <tbody>
                @foreach($transactions as $transaction)
                    <tr>
                        <td valign="middle">{{ $transaction->userAddress->name }}</td>
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
                                    @if($transaction->latestHistory->status === \App\Constants\MidtransStatusConstant::PENDING)
                                        <li>
                                            <a
                                                class="dropdown-item"
                                                href="{{ $transaction->snap_url }}"
                                            >{{ __("Pay") }}</a>
                                        </li>
                                    @endif
                                    @if($transaction->latestHistory->status >= \App\Constants\MidtransStatusConstant::ARRIVED && !$transaction->is_reviewed)
                                        <li>
                                            <a
                                                class="dropdown-item review"
                                                href="javascript:void(0)"
                                                data-bs-toggle="modal"
                                                data-bs-target="#review-modal"
                                                data-tx="{{ $transaction }}"
                                            >{{ __("Review") }}</a>
                                        </li>
                                    @endif
                                    @if($transaction->latestHistory->status === \App\Constants\MidtransStatusConstant::ARRIVED)
                                        <li>
                                            <a
                                                class="dropdown-item refund"
                                                href="javascript:void(0)"
                                                data-bs-toggle="modal"
                                                data-bs-target="#refund-modal"
                                                data-tx="{{ $transaction }}"
                                            >{{ __("Return") }}</a>
                                        </li>
                                    @endif
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
                        <h1 class="modal-title fs-5" id="transaction-detail-modal-label">Pengembalian Produk</h1>
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
        <div class="modal fade" id="review-modal" tabindex="-1" aria-labelledby="review-modal-label" aria-hidden="true">
            <form method="POST" action="{{ route("review.store") }}" enctype="multipart/form-data" class="modal-dialog">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Review</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input
                            id="transaction_id"
                            type="number"
                            class="form-control d-none"
                            name="transaction_id"
                            value=""
                            required
                            autocomplete="transaction_id"
                            autofocus
                        />

                        <div class="">
                            <label for="review">{{ __("Review") }}</label>
                            <input
                                id="review"
                                type="text"
                                class="form-control @error("review") is-invalid @enderror"
                                name="review"
                                value="{{ old("review") }}"
                                required
                                autocomplete="review"
                                autofocus
                            />
                            @error("review")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="attachments">{{ __("Attachments") }}</label>
                            <input
                                id="attachments"
                                type="file"
                                class="form-control @error("attachments") is-invalid @enderror"
                                name="attachments[]"
                                value=""
                                required
                                autocomplete="attachments"
                                accept="image/*,video/*"
                                multiple
                            />
                            @error("attachments")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal fade" id="refund-modal" tabindex="-1" aria-labelledby="refund-modal-label" aria-hidden="true">
            <form method="POST" action="{{ route("refund.store") }}" enctype="multipart/form-data" class="modal-dialog">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Pengembalian Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input
                            id="tx_id"
                            type="number"
                            class="form-control d-none"
                            name="tx_id"
                            value=""
                            required
                            autocomplete="tx_id"
                            autofocus
                        />

                        <div class="">
                            <label for="reason">{{ __("Reason") }}</label>
                            <input
                                id="reason"
                                type="text"
                                class="form-control @error("reason") is-invalid @enderror"
                                name="reason"
                                value="{{ old("reason") }}"
                                required
                                autocomplete="reason"
                                autofocus
                            />
                            @error("reason")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="attachments">{{ __("Attachments") }}</label>
                            <input
                                id="attachments"
                                type="file"
                                class="form-control @error("attachments") is-invalid @enderror"
                                name="attachments[]"
                                value=""
                                required
                                autocomplete="attachments"
                                accept="image/*,video/*"
                                multiple
                            />
                            @error("attachments")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        let title = document.getElementById("transaction-detail-modal-label");
        let tracking = document.getElementById("transaction-detail-tracking");
        let transactions = document.getElementsByClassName("transaction-detail");
        let reviews = document.getElementsByClassName("review");
        let refunds = document.getElementsByClassName("refund");
        let transactionId = document.getElementById("transaction_id");
        let txId = document.getElementById("tx_id");
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
        for (let i = 0; i < reviews.length; i++) {
            let review = reviews[i];
            review.onclick = function () {
                let data = JSON.parse(this.getAttribute("data-tx"));
                transactionId.value = data.id;
            }
        }
        for (let i = 0; i < refunds.length; i++) {
            let refund = refunds[i];
            refund.onclick = function () {
                let data = JSON.parse(this.getAttribute("data-tx"));
                txId.value = data.id;
            }
        }
    </script>
</div>
@endsection
