@extends('admin.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/multi-dropdown.css') }}" />
@endsection

@section('admin')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- Page Heading -->
                <h5 class="card-title fw-semibold mb-4">Tambah Data Karyawan </h5>
                <div class="container-fluid">
                    <!-- Form Tambah Data -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row py-3 d-flex justify-content-between align-items-center">
                                <div class="col-8">
                                    @if (Session::has('success'))
                                        <div id="delay" class="alert alert-success" role="alert">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif
                                    @if (Session::has('error'))
                                        <div id="delay" class="alert alert-danger" role="alert">
                                            {{ Session::get('error') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="col-2-kembali">
                                    <p><a href="{{ route('karyawan') }}" class="btn btn-success"> Kembali</a></p>
                                </div>
                            </div>
                            <form method="post" action="{{ route('karyawan.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="akunUser" class="form-label">Akun User *</label>
                                    <select class="form-select" aria-label="Default select example" name="akunUser"
                                        id="akunUser" required>
                                        <option selected disabled>Pilih Akun User</option>
                                        @foreach ($data_user as $data)
                                            @php
                                                $isDisabled = \App\Models\pegawai::where(
                                                    'user_id',
                                                    $data->id,
                                                )->exists();
                                            @endphp
                                            @unless ($isDisabled)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endunless
                                        @endforeach
                                    </select>
                                    @error('akunUser')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="divisi" class="form-label">Divisi *</label>
                                    <select class="form-select" aria-label="Default select example" name="divisi"
                                        id="divisi" required>
                                        <option selected disabled>Pilih Divisi</option>
                                        @foreach ($data_divisi as $data)
                                            <option value="{{ $data->id_divisi }}">{{ $data->deskripsi }}</option>
                                        @endforeach
                                    </select>
                                    @error('divisi')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Karyawan *</label>
                                    <input type="text" class="form-control" id="nama" name="nama">
                                    @error('nama')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP *</label>
                                    <input type="number" class="form-control" id="nip" name="nip">
                                    @error('nip')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('backend/assets/js/jquery3-1-1.js') }}"></script>
    <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/multi-dropdown.js') }}"></script>
@endsection
