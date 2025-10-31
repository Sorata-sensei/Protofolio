@extends('admin.template.index')

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
    <style>
        .editor {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            min-height: 200px;
            margin-bottom: 20px;
            overflow-y: auto;
            background-color: #f9f9f9;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .editor-toolbar {
            margin-bottom: 10px;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
@endpush

@section('content')
    <div class="container">

        <form action="{{ route('admin.activities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tag">Tag</label>
                <select name="tag" id="tag" class="form-control">
                    <option value="Sertifikat">Sertifikat</option>
                    <option value="Penghargaan">Penghargaan</option>
                    <option value="Kualifikasi">Kualifikasi</option>
                    <option value="Seminar">Seminar</option>
                    <option value="Workshop">Workshop</option>
                    <option value="Pelatihan">Pelatihan</option>
                    <option value="Konferensi">Konferensi</option>
                    <option value="Wisuda">Wisuda</option>
                    <option value="Kelulusan">Kelulusan</option>
                    <option value="Graduasi">Graduasi</option>
                    <option value="Pekerjaan Baru">Pekerjaan Baru</option>
                    <option value="Karir">Karir</option>
                    <option value="Lowongan Kerja">Lowongan Kerja</option>
                    <option value="Abdimas">Abdimasi</option>
                    <option value="HAKI">HAKI</option>
                </select>
            </div>
            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" name="link" class="form-control">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-control">
                    <option value="Edukasi">Edukasi</option>
                    <option value="Karir">Karir</option>
                    <option value="Pengembangan Diri">Pengembangan Diri</option>
                    <option value="Sertifikasi">Sertifikasi</option>
                    <option value="Acara">Acara</option>
                    <option value="Pengabdian Masyarakat">Pengabdian Masyarakat</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input id="description" type="hidden" name="description">
                <trix-editor input="description" class="editor"></trix-editor>
            </div>
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-success mt-3">Simpan</button>
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
