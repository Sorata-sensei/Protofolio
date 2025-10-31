@extends('admin.template.index')

@section('content')
    <div class="container">

        <form method="GET" action="{{ route('admin.visitor.daily_chart') }}" class="mb-4">
            <label for="year">Select Year:</label>
            <select name="year" id="year" onchange="this.form.submit()">
                @for ($i = 2020; $i <= now()->year; $i++)
                    <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>

            <label for="month">Select Month:</label>
            <select name="month" id="month" onchange="this.form.submit()">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>
                        {{ Carbon\Carbon::create()->month($i)->format('F') }}
                    </option>
                @endfor
            </select>
        </form>

        <canvas id="dailyVisitorChart" width="400" height="200"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const labels = @json($days);
            const totals = @json($totals);

            const ctx = document.getElementById('dailyVisitorChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Visitors',
                        data: totals,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Visitors'
                            }
                        }
                    }
                }
            });
        });
    </script>
@endsection
