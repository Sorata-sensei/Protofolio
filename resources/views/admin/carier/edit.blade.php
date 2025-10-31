@extends('admin.template.index')
@push('css')
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
        <h1 class="mt-4">Edit Data Karier</h1>
        <a href="{{ route('carier.admin.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Karier</a>

        <form action="{{ route('carier.admin.update', $carier->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Tambahkan ini untuk metode HTTP PUT -->
            <div class="mb-3">
                <label for="company_name" class="form-label">Nama Perusahaan</label>
                <input type="text" name="company_name" id="company_name" class="form-control"
                    value="{{ old('company_name', $carier->company_name) }}" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <input type="text" name="role" id="role" class="form-control"
                    value="{{ old('role', $carier->role) }}" required>
            </div>
            <div class="mb-3">
                <label for="job_status" class="form-label">Job Status</label>
                <input type="text" name="job_status" id="job_status" class="form-control"
                    value="{{ old('job_status', $carier->job_status) }}" required>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" id="start_date" class="form-control"
                    value="{{ old('start_date', $carier->start_date) }}" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">Tanggal Selesai</label>
                <input type="date" name="end_date" id="end_date" class="form-control"
                    value="{{ old('end_date', $carier->end_date) }}">
                <small class="text-muted">Kosongkan jika masih bekerja</small>
            </div>
            <div class="mb-3">
                <label for="current_status" class="form-label">Status Saat Ini</label>
                <input type="text" name="current_status" id="current_status" class="form-control"
                    value="{{ old('current_status', $carier->current_status) }}">
                <small class="text-muted">Contoh: Masih bekerja</small>
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Logo Perusahaan</label>
                <input type="file" name="logo" id="logo" class="form-control">
                <small class="text-muted">Opsional. Maks: 2MB (jpg, jpeg, png)</small>
            </div>
            @if ($carier->logo)
                <p>Current logo: {{ $carier->image }}</p>
                <img src="{{ asset('storage/' . $carier->logo) }}" width="100" class="mt-2">
            @endif
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi Pengalaman</label>
                <div class="editor-toolbar">
                    <button type="button" onclick="formatText('bold')">Bold</button>
                    <button type="button" onclick="formatText('italic')">Italic</button>
                    <button type="button" onclick="formatText('underline')">Underline</button>
                    <button type="button" onclick="formatText('removeFormat')">Remove Format</button>
                    <button type="button" onclick="addLink()">Add Link</button>
                    <button type="button" onclick="addImage()">Add Image</button>
                    <input type="color" id="textColor" onchange="changeTextColor(this.value)" title="Change Text Color">
                    <button type="button" onclick="formatText('justifyLeft')">Align Left</button>
                    <button type="button" onclick="formatText('justifyCenter')">Align Center</button>
                    <button type="button" onclick="formatText('justifyRight')">Align Right</button>
                    <button type="button" onclick="formatText('insertUnorderedList')">Bullet List</button>
                    <button type="button" onclick="formatText('insertOrderedList')">Numbered List</button>
                </div>
                <div id="description" class="editor" contenteditable="true">{{ old('description') }}
                    {!! $carier->description !!}</div>
                <input type="hidden" name="description" id="description-input">
            </div>
            <!-- Tombol untuk mengubah skill -->
            <button type="button" id="ubah-skill-btn" class="btn btn-primary mb-3">Ubah Skill</button>

            <!-- Dropdown untuk memilih keahlian -->
            <div id="skill-dropdown" style="display: none;">
                <div class="mb-3">
                    <label for="skills" class="form-label">Keahlian</label>
                    <select name="skills[]" id="skills" class="form-control" multiple="multiple">
                        @foreach ($skills as $skill)
                            <option value="{{ $skill->skill_name }}"
                                {{ in_array($skill->skill_name, old('skills', [])) ? 'selected' : '' }}>
                                {{ $skill->skill_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Menampilkan keahlian yang sudah ada -->
            <div id="existing-skills">
                @foreach ($carierSkills as $skillschoice)
                    <p class="btn btn-group btn-primary">{{ $skillschoice }}</p>
                @endforeach
                <input type="hidden" name="skillold" id="skill" value="no">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
@include('admin.footer.footer')
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script>
        // Inisialisasi Select2 pada elemen select dengan id "skills"
        $(document).ready(function() {
            $('#skills').select2({
                placeholder: "Pilih Keahlian",
                allowClear: true,
                width: '100%'
            });

            // Menyimpan konten editor ke input hidden saat form disubmit
            $('form').on('submit', function() {
                $('#description-input').val($('#description').html());
            });
            // Menangani klik tombol "Ubah Skill"
            $('#ubah-skill-btn').on('click', function() {
                $('#skill-dropdown').toggle(); // Menampilkan atau menyembunyikan dropdown
                $('#existing-skills').toggle(); // Menampilkan atau menyembunyikan keahlian yang sudah ada
            });
        });

        // Fungsi untuk memformat teks
        function formatText(command) {
            document.execCommand(command, false, null);
        }

        // Fungsi untuk menambahkan link
        function addLink() {
            var url = prompt("Masukkan URL:", "http://");
            if (url) {
                document.execCommand('createLink', false, url);
            }
        }

        // Fungsi untuk menambahkan gambar
        function addImage() {
            var imageUrl = prompt("Masukkan URL Gambar:", "http://");
            if (imageUrl) {
                document.execCommand('insertImage', false, imageUrl);
            }
        }

        // Fungsi untuk mengubah warna teks
        function changeTextColor(color) {
            document.execCommand('foreColor', false, color);
        }
    </script>
@endpush
