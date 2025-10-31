@extends('admin.template.index')
@push('css')
@endpush
@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card p-3 sh">
            @if ($cariers->isEmpty())
                <p>Tidak ada data karier.</p>
            @else
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Nama Perusahaan</th>
                            <th>Role</th>
                            <th>Job Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cariers as $index => $carier)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    @if ($carier->logo)
                                        <img src="{{ asset('storage/' . $carier->logo) }}" alt="Logo"
                                            style="width: 50px; height: 50px;">
                                    @else
                                        Tidak ada logo
                                    @endif
                                </td>
                                <td>{{ $carier->company_name }}</td>
                                <td>{{ $carier->role }}</td>
                                <td>{{ $carier->job_status }}</td>
                                <td>{{ $carier->start_date }}</td>
                                <td>{{ $carier->end_date ?? 'Masih bekerja' }}</td>
                                <td>{{ $carier->current_status ?? '-' }}</td>
                                <td>
                                    <p>
                                        <a href="{{ route('carier.admin.edit', $carier->id) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('carier.admin.destroy', $carier->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection
@include('admin.footer.footer')
@push('scripts')
@endpush
