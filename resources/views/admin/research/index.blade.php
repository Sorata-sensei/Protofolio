@extends('admin.template.index')

@push('css')
@endpush

@section('content')
    <div class="container mt-4">
        {{-- <div class="mb-3">
            <a class="btn btn-primary" href="{{ route('research.admin.create') }}">Add New Journal</a>
            <a class="btn btn-warning" href="{{ route('research.admin.addFakeData') }}">Add Fake Data</a>
            <a class="btn btn-danger" href="{{ route('research.admin.deleteAll') }}"
                onclick="return confirm('Delete all data?')">Delete All</a>
            <a href="{{ route('dashboard.admin.index') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
        </div> --}}

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Authors</th>
                        <th>Publisher</th>
                        <th>Year</th>
                        <th>Abstract</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($journals as $journal)
                        <tr>
                            <td>{{ $journal->title }}</td>
                            <td>{{ $journal->formattedAuthors() }}</td>
                            <td>{{ $journal->publisher }}</td>
                            <td>{{ $journal->year }}</td>
                            <td>{!! Str::limit($journal->abstract, 100) !!}</td>
                            <td>
                                <p>
                                    <a href="{{ $journal->journal_link }}" target="_blank" class="btn btn-info btn-sm">View</a>
                                <form action="{{ route('research.admin.destroy', $journal->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@include('admin.footer.footer')

@push('scripts')
@endpush
