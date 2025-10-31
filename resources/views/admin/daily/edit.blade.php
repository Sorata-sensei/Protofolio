@extends('admin.template.index')

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
@endpush

@section('content')
    <div class="container">
        <a href="{{ route('dashboard.admin.index') }}" class="btn btn-secondary mb-3">Kembali ke Dashboard</a>
        <h1 class="text-center mt-3">Edit Activity</h1>
        <form action="{{ route('admin.activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" value="{{ $activity->title }}" required>
            </div>
            <div class="form-group">
                <label for="tag">Tag</label>
                <select name="tag" id="tag" class="form-control">
                    <option value="Sertifikat" {{ $activity->tag == 'Sertifikat' ? 'selected' : '' }}>Sertifikat</option>
                    <option value="Penghargaan" {{ $activity->tag == 'Penghargaan' ? 'selected' : '' }}>Penghargaan</option>
                    <option value="Kualifikasi" {{ $activity->tag == 'Kualifikasi' ? 'selected' : '' }}>Kualifikasi</option>
                    <option value="Seminar" {{ $activity->tag == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                    <option value="Workshop" {{ $activity->tag == 'Workshop' ? 'selected' : '' }}>Workshop</option>
                    <option value="Pelatihan" {{ $activity->tag == 'Pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                    <option value="Konferensi" {{ $activity->tag == 'Konferensi' ? 'selected' : '' }}>Konferensi</option>
                    <option value="Wisuda" {{ $activity->tag == 'Wisuda' ? 'selected' : '' }}>Wisuda</option>
                    <option value="Kelulusan" {{ $activity->tag == 'Kelulusan' ? 'selected' : '' }}>Kelulusan</option>
                    <option value="Graduasi" {{ $activity->tag == 'Graduasi' ? 'selected' : '' }}>Graduasi</option>
                    <option value="Pekerjaan Baru" {{ $activity->tag == 'Pekerjaan Baru' ? 'selected' : '' }}>Pekerjaan
                        Baru</option>
                    <option value="Karir" {{ $activity->tag == 'Karir' ? 'selected' : '' }}>Karir</option>
                    <option value="Lowongan Kerja" {{ $activity->tag == 'Lowongan Kerja' ? 'selected' : '' }}>Lowongan
                        Kerja</option>
                    <option value="Abdimas" {{ $activity->tag == 'Abdimas' ? 'selected' : '' }}>Abdimas</option>
                    <option value="HAKI" {{ $activity->tag == 'HAKI' ? 'selected' : '' }}>HAKI</option>
                </select>
            </div>

            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" name="link" class="form-control" value="{{ $activity->link }}">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="Edukasi" {{ $activity->type == 'Edukasi' ? 'selected' : '' }}>Edukasi</option>
                    <option value="Karir" {{ $activity->type == 'Karir' ? 'selected' : '' }}>Karir</option>
                    <option value="Pengembangan Diri" {{ $activity->type == 'Pengembangan Diri' ? 'selected' : '' }}>
                        Pengembangan Diri</option>
                    <option value="Sertifikasi" {{ $activity->type == 'Sertifikasi' ? 'selected' : '' }}>Sertifikasi
                    </option>
                    <option value="Acara" {{ $activity->type == 'Acara' ? 'selected' : '' }}>Acara</option>
                    <option value="Pengabdian Masyarakat"
                        {{ $activity->type == 'Pengabdian Masyarakat' ? 'selected' : '' }}>Pengabdian Masyarakat</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <input id="description" type="hidden" name="description"
                    value="{{ old('description', $activity->description) }}">
                <trix-editor input="description" class="form-control" style="min-height: 150px;"></trix-editor>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" value="{{ $activity->date }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
                @if ($activity->image)
                    <img src="{{ asset('storage/images/' . $activity->image) }}" width="100" class="mt-2">
                    <p>Current Image: {{ $activity->image }}</p>
                @endif
            </div>
            <button type="submit" class="btn btn-success mt-3">Update</button>
        </form>
    </div>
@endsection

@include('admin.footer.footer')

@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.js"></script>
    <script>
        // Trix Editor setup (if needed, you can add further configuration here)
        document.addEventListener("trix-initialize", function(event) {
            let editor = event.target;
            console.log("Trix Editor initialized", editor);
        });
    </script>
@endpush
