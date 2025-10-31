@extends('admin.template.index')

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
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

        .editor-toolbar button {
            margin-right: 5px;
            border: none;
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .editor-toolbar button:hover {
            background-color: #0056b3;
        }

        .editor-toolbar input[type="color"] {
            border: none;
            padding: 5px;
            border-radius: 3px;
            cursor: pointer;
        }

        .editor-toolbar input[type="color"]:hover {
            border: 1px solid #007bff;
        }

        .editor-toolbar button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container ">
        <div class="card p-4">
            <form action="{{ route('carier.admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="company_name" class="form-label">Nama Perusahaan</label>
                    <input type="text" name="company_name" id="company_name" class="form-control"
                        value="{{ old('company_name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <input type="text" name="role" id="role" class="form-control" value="{{ old('role') }}"
                        required>
                </div>
                <div class="mb-3">
                    <label for="job_status" class="form-label">Job Status</label>
                    <input type="text" name="job_status" id="job_status" class="form-control"
                        value="{{ old('job_status') }}" required>
                </div>
                <div class="mb-3">
                    <label for="start_date" class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ old('start_date') }}" required>
                </div>
                <div class="mb-3">
                    <label for="end_date" class="form-label">Tanggal Selesai</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                    <small class="text-muted">Kosongkan jika masih bekerja</small>
                </div>
                <div class="mb-3">
                    <label for="current_status" class="form-label">Status Saat Ini</label>
                    <input type="text" name="current_status" id="current_status" class="form-control"
                        value="{{ old('current_status') }}">
                    <small class="text-muted">Contoh: Masih bekerja</small>
                </div>
                <div class="mb-3">
                    <label for="logo" class="form-label">Logo Perusahaan</label>
                    <input type="file" name="logo" id="logo" class="form-control">
                    <small class="text-muted">Opsional. Maks: 2MB (jpg, jpeg, png)</small>
                </div>
                <div class="mb-3">
                    <label for="description">Description</label>
                    <input id="description" type="hidden" name="description">
                    <trix-editor input="description" class="editor"></trix-editor>
                </div>

                <div class="mb-3">
                    <label for="skills" class="form-label">Keahlian</label>
                    <select name="skills[]" id="skills" class="form-control" multiple="multiple" required>
                        @foreach ($skills as $skill)
                            <option value="{{ $skill->skill_name }}"
                                {{ in_array($skill->skill_name, old('skills', [])) ? 'selected' : '' }}>
                                {{ $skill->skill_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@include('admin.footer.footer')
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.js"></script>
    <script>
        // Trix Editor setup (if needed, you can add further configuration here)
        document.addEventListener("trix-initialize", function(event) {
            let editor = event.target;
            console.log("Trix Editor initialized", editor);
        });
    </script>
    <script>
        // Inisialisasi Select2 pada elemen select dengan id "skills"
        $(document).ready(function() {
            $('#skills').select2({
                placeholder: "Pilih Keahlian",
                allowClear: true,
                width: '100%'
            });
        });
    </script>
@endpush
