@extends("admin.layouts.app")

@section("content")
<div class="container">
    <canvas id="chart" class="w-100"></canvas>

    <script>
        const ctx = document.getElementById('chart');

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: "# of Transactions",
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
