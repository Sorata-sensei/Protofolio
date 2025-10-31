@extends('admin.template.index')

@push('css')
    <!-- Tambahkan CSS tambahan jika diperlukan -->
@endpush

@section('content')
    <div class="container">

        <form method="GET" action="{{ route('admin.visitor.chart') }}">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="year" class="form-label">Select Year</label>
                    <select name="year" id="year" class="form-control">
                        @for ($i = now()->year; $i >= 2000; $i--)
                            <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <canvas id="countryChart"></canvas>
    </div>
@endsection

@include('admin.footer.footer')

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chartData);

        const ctx = document.getElementById('countryChart').getContext('2d');
        const countryChart = new Chart(ctx, {
            type: 'bar', // Ubah 'pie' menjadi 'bar'
            data: {
                labels: chartData.map(data => data.name),
                datasets: [{
                    label: 'Number of Visitors',
                    data: chartData.map(data => data.value),
                    backgroundColor: chartData.map(data => data.color),
                    borderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Country',
                        },
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Visitors',
                        },
                    },
                }
            }
        });
    </script>
@endpush
