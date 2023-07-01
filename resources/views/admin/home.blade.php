@extends("admin.layouts.app")

@section("content")
<div class="container">
    <div class="row">
        <div class="col-12 col-md-3 offset-md-9">
            <select
                id="filter"
                class="form-select"
                name="filter"
                required
                autocomplete="filter"
                autofocus
                onchange="location = this.options[this.selectedIndex].value"
            >
                @foreach($filters as $filter)
                    <option value="{{ url()->current() }}?filter={{ $filter["value"] }}" {{ $filter["value"] === $currentFilter ? "selected" : "" }}>{{ $filter["label"] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-10 offset-md-1">
            <canvas id="chart" class="w-100 mt-3"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('chart');

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: "Income of Transactions",
                    data: {!! json_encode($data) !!},
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</div>
@endsection
