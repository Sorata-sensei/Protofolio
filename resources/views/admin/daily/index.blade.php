@extends('admin.template.index')

@push('css')
    <style>
        .pagination-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .pagination {
            display: flex;
            justify-content: center;
        }

        .pagination .page-item {
            margin: 0 5px;
        }

        .text-muted {
            text-align: center;
            margin: 10px 0;
        }

        .img-details {
            font-size: 12px;
            color: gray;
            margin-top: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="container">


        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Link</th>
                        <th>Image</th>
                        <th>Dimensions (W x H)</th>
                        <th>Size (KB)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td>{{ $activity->title }}</td>
                            <td>{!! Str::limit($activity->description, 100) !!}</td>
                            <td>{{ $activity->date }}</td>
                            <td>{{ $activity->link ?? 'empty' }}</td>

                            <td>
                                @if ($activity->image)
                                    <img src="{{ asset('storage/images/' . $activity->image) }}" width="100"
                                        class="img-fluid">
                                @endif
                            </td>
                            <td>
                                @if ($activity->width && $activity->height)
                                    {{ $activity->width }} x {{ $activity->height }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if ($activity->size)
                                    {{ $activity->size }} KB
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <p>

                                    <a href="{{ route('admin.activities.edit', $activity->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-container">
            <div class="pagination">
                {{ $activities->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
@endsection

@include('admin.footer.footer')

@push('scripts')
@endpush
