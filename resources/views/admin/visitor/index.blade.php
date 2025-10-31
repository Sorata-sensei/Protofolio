@extends('admin.template.index')

@push('css')
@endpush

@section('content')
    <div class="container mt-4">

        <!-- Form Pencarian dan Filter -->
        <form method="GET" action="{{ route('admin.visitor.index') }}" class="mb-4">
            <div class="row mx-auto">
                <div class="col-md-2">
                    <input type="text" name="search" class="form-control" placeholder="Cari..."
                        value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-3">
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
                <div class="col-md-3">
                    <a href="{{ route('admin.visitor.month_chart') }}" class="btn btn-success">Chart Month</a>
                    <a href="{{ route('admin.visitor.daily_chart') }}" class="btn btn-success">Chart Daily</a>
                    <a href="{{ route('admin.visitor.chart') }}" class="btn btn-success">Chart</a>
                </div>
            </div>
        </form>

        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>IP</th>
                    <th>Device</th>
                    <th>Version</th>
                    <th>Tanggal</th>
                    <th>Negara</th>
                    <th>ISP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->ip }}</td>
                        <td>{{ $log->device }}</td>
                        <td>{{ $log->version }}</td>
                        <td>{{ \Carbon\Carbon::parse($log->date)->translatedFormat('l, d F Y') }}</td>
                        <td>{{ $log->country_name ?? '-' }}</td>
                        <td>{{ $log->isp ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination">
            {{ $logs->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@include('admin.footer.footer')

@push('scripts')
@endpush
