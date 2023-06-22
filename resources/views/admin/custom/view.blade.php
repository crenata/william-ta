@extends("admin.layouts.app")

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

        <div class="table-responsive mt-4" style="height: 75vh;">
            <table class="table">
                <thead>
                <tr>
                    <th>User</th>
                    <th>Phone</th>
                    <th>Address</th>
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
                        <td valign="middle">{{ $transaction->user->name }}</td>
                        <td valign="middle">{{ $transaction->user->phone }}</td>
                        <td valign="middle">{{ $transaction->userAddress->address }}</td>
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
                                    @if($transaction->latestHistory->status === \App\Constants\MidtransStatusConstant::SETTLEMENT)
                                        <li>
                                            <a
                                                class="dropdown-item transaction-status"
                                                href="javascript:void(0)"
                                                data-bs-toggle="modal"
                                                data-bs-target="#transaction-status-modal"
                                                data-tx="{{ $transaction }}"
                                            >{{ __("Edit Status") }}</a>
                                        </li>
                                    @endif
                                    @if($transaction->latestHistory->status === \App\Constants\MidtransStatusConstant::PENDING)
                                        <li>
                                            <a
                                                class="dropdown-item transaction-price"
                                                href="javascript:void(0)"
                                                data-bs-toggle="modal"
                                                data-bs-target="#transaction-price-modal"
                                                data-tx="{{ $transaction }}"
                                            >{{ __("Input Price") }}</a>
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
        <div class="modal fade" id="transaction-status-modal" tabindex="-1" aria-labelledby="transaction-status-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route("custom.store") }}" class="modal-content">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="transaction-status-modal-label">Change Status</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input
                            id="custom_transaction_id"
                            type="number"
                            class="form-control d-none"
                            name="custom_transaction_id"
                            value=""
                            required
                            autocomplete="custom_transaction_id"
                            autofocus
                        />

                        <div class="">
                            <label for="status">{{ __("Status") }}</label>
                            <select
                                id="status"
                                class="form-select @error("status") is-invalid @enderror"
                                name="status"
                                required
                                autocomplete="status"
                                autofocus
                            >
                                <option id="current-status">Choose Status</option>
                                @foreach($statuses as $key => $status)
                                    <option value="{{ $status }}">{{ $key }}</option>
                                @endforeach
                            </select>
                            @error("status")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" id="transaction-price-modal" tabindex="-1" aria-labelledby="transaction-price-modal-label" aria-hidden="true">
            <div class="modal-dialog">
                <form method="POST" action="{{ route("custom.update", ":id") }}" id="form-price" class="modal-content">
                    @csrf
                    @method("PUT")

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="transaction-price-modal-label">Input Price</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="">
                            <label for="price">{{ __("Price") }}</label>
                            <input
                                id="price"
                                type="number"
                                class="form-control @error("price") is-invalid @enderror"
                                name="price"
                                value="{{ old("price") }}"
                                autocomplete="price"
                                autofocus
                                min="1"
                                required
                            />
                            @error("price")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let title = document.getElementById("transaction-detail-modal-label");
        let tracking = document.getElementById("transaction-detail-tracking");
        let transactionId = document.getElementById("custom_transaction_id");
        let status = document.getElementById("status");
        let formPrice = document.getElementById("form-price");
        let price = document.getElementById("price");
        let currentStatus = document.getElementById("current-status");
        let transactions = document.getElementsByClassName("transaction-detail");
        let statuses = document.getElementsByClassName("transaction-status");
        let prices = document.getElementsByClassName("transaction-price");
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
                case {{ \App\Constants\MidtransStatusConstant::PRICE_SUBMITTED }}:
                    return "Harga telah diinput";
                default:
                    return "Status tidak diketahui";
            }
        };
        const getStatusName = status => {
            switch (status) {
                case {{ \App\Constants\MidtransStatusConstant::SETTLEMENT }}:
                    return "Settlement";
                case {{ \App\Constants\MidtransStatusConstant::DENY }}:
                    return "Deny";
                case {{ \App\Constants\MidtransStatusConstant::PENDING }}:
                    return "Pending";
                case {{ \App\Constants\MidtransStatusConstant::CANCEL }}:
                    return "Cancel";
                case {{ \App\Constants\MidtransStatusConstant::REFUND }}:
                    return "Refund";
                case {{ \App\Constants\MidtransStatusConstant::PARTIAL_REFUND }}:
                    return "Partial Refund";
                case {{ \App\Constants\MidtransStatusConstant::EXPIRE }}:
                    return "Expire";
                case {{ \App\Constants\MidtransStatusConstant::FAILURE }}:
                    return "Failure";
                case {{ \App\Constants\MidtransStatusConstant::PROCESSED }}:
                    return "Processed";
                case {{ \App\Constants\MidtransStatusConstant::DELIVERY }}:
                    return "Delivery";
                case {{ \App\Constants\MidtransStatusConstant::ARRIVED }}:
                    return "Arrived";
                case {{ \App\Constants\MidtransStatusConstant::REQUEST_RETURN }}:
                    return "Request Return";
                case {{ \App\Constants\MidtransStatusConstant::RETURN_REJECTED }}:
                    return "Return Rejected";
                case {{ \App\Constants\MidtransStatusConstant::PROCESS_RETURN }}:
                    return "Process Return";
                case {{ \App\Constants\MidtransStatusConstant::RETURNED }}:
                    return "Returned";
                case {{ \App\Constants\MidtransStatusConstant::PRICE_SUBMITTED }}:
                    return "Price Submitted";
                default:
                    return "Unknown";
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
        for (let i = 0; i < statuses.length; i++) {
            let sts = statuses[i];
            sts.onclick = function () {
                let data = JSON.parse(this.getAttribute("data-tx"));
                transactionId.value = data.id;
                currentStatus.textContent = getStatusName(data.latest_history.status);
            }
        }
        for (let i = 0; i < prices.length; i++) {
            let sts = prices[i];
            sts.onclick = function () {
                let data = JSON.parse(this.getAttribute("data-tx"));
                formPrice.setAttribute("action", "{{ route("custom.update", ":id") }}".replace(":id", data.id));
            }
        }
    </script>
</div>
@endsection
