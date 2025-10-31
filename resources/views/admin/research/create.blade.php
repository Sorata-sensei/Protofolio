@extends('admin.template.index')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.css">
    <style>
        .editor {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            min-height: 150px;
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

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container  mt-5">
        <div class="card p-3">

            <form action="{{ route('research.admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Judul:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="mb-3">
                    <label for="authors" class="form-label">Penulis:</label>
                    <div id="authorsContainer">
                        <input type="text" class="form-control mb-2" name="authors[]" placeholder="Nama Penulis"
                            required>
                    </div>
                    <button type="button" class="btn btn-secondary mt-2" onclick="addAuthor()">Tambah Penulis</button>
                </div>

                <div class="mb-3">
                    <label for="journal" class="form-label">Publisher:</label>
                    <input type="text" class="form-control" id="journal" name="publisher" required>
                </div>

                <div class="mb-3">
                    <label for="year" class="form-label">Tahun:</label>
                    <input type="number" class="form-control" id="year" name="year" required>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link PDF (Opsional):</label>
                    <input type="text" class="form-control" id="link" name="journal_link"
                        placeholder="Masukkan link PDF">
                </div>

                <div class="mb-3">
                    <label for="abstract">Abstract</label>
                    <input id="abstract" type="hidden" name="abstract">
                    <trix-editor input="abstract" class="editor"></trix-editor>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
@include('admin.footer.footer')
@push('scripts')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/trix@1.3.1/dist/trix.js"></script>

    <script>
        function addAuthor() {
            const authorsContainer = document.getElementById('authorsContainer');
            const newAuthorInput = document.createElement('input');
            newAuthorInput.type = 'text';
            newAuthorInput.className = 'form-control mb-2';
            newAuthorInput.name = 'authors[]';
            newAuthorInput.placeholder = 'Nama Penulis';
            authorsContainer.appendChild(newAuthorInput);
        }
    </script>

    <script>
        // Trix Editor setup (if needed, you can add further configuration here)
        document.addEventListener("trix-initialize", function(event) {
            let editor = event.target;
            console.log("Trix Editor initialized", editor);
        });
    </script>
@endpush
