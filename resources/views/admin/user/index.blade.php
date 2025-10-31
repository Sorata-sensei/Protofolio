@extends('admin.template.index')
@push('css')
    <style>
        .container {
            width: 100%;
            padding: 0;
            margin-right: auto;
            margin-left: auto;
        }
    </style>
@endpush
@section('content')
    <div class="container pt-5">
        <form action="{{ route('user.admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="staticnama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control-plaintext" id="staticnama" name="nama"
                        value="{{ $user->name }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control-plaintext" id="staticEmail" name="email"
                        value="{{ $user->email }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputcv" class="col-sm-2 col-form-label">CV</label>

                @if (isset($user) && $user->cv)
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="formFile" name="cv" accept="application/pdf">
                    </div>
                    <div class="col-sm-10 pt-4">
                        <a href="{{ asset('storage/' . $user->cv) }}" target="_blank"
                            class="form-control btn w-25 btn-primary">Buka
                            CV</a>
                    </div>
                @else
                    <div class="col-sm-10">
                        <input class="form-control" type="file" id="formFile" name="cv" accept="application/pdf">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary w-100">Ubah Data</button>
        </form>
    </div>
@endsection
@include('admin.footer.footer')
@push('scripts')
@endpush
