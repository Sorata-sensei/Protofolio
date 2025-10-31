@extends('admin.template.index')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endpush

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Statistik Pengunjung</h1>

        <div class="row">
            <div class="col-md-6">
                <h3>Diagram Pie Negara Pengunjung</h3>
                <canvas id="countryPieChart"></canvas>
            </div>
            <div class="col-md-6">
                <h3>Grafik Batang Device Pengunjung</h3>
                <canvas id="deviceBarChart"></canvas>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Data untuk diagram pie
            const countryData = @json($countryData);
            const countryLabels = Object.keys(countryData);
            const countryValues = Object.values(countryData);

            const ctxPie = document.getElementById('countryPieChart').getContext('2d');
            const countryPieChart = new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: countryLabels,
                    datasets: [{
                        label: 'Jumlah Pengunjung per Negara',
                        data: countryValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Statistik Pengunjung per Negara'
                        }
                    }
                }
            });

            // Data untuk grafik batang
            const deviceData = @json($deviceData);
            const deviceLabels = Object.keys(deviceData);
            const deviceValues = Object.values(deviceData);

            const ctxBar = document.getElementById('deviceBarChart').getContext('2d');
            const deviceBarChart = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: deviceLabels,
                    datasets: [{
                        label: 'Jumlah Pengunjung per Device',
                        data: deviceValues,
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
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: 'Statistik Pengunjung per Device'
                        }
                    }
                }
            });
        </script>
    @endpush
@endsection
