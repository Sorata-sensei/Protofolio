@extends('admin.template.index')

@section('content')
    <div class="container">
        <form method="GET" action="{{ route('admin.visitor.month_chart') }}">
            <label for="year">Select Year:</label>
            <select name="year" id="year" onchange="this.form.submit()">
                @for ($i = 2020; $i <= now()->year; $i++)
                    <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </form>
        <canvas id="visitorChart" width="400" height="200"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const labels = @json($months);
            const totals = @json($totals);

            const ctx = document.getElementById('visitorChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Visitors',
                        data: totals,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
@endsection
