@extends('admin.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/multi-dropdown.css') }}" />
@endsection

@section('admin')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- Page Heading -->
                <h5 class="card-title fw-semibold mb-4">Tambah Data Karyawan</h5>
                <div class="container-fluid">
                    <!-- Form Tambah Data -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row justify-content-end">
                                <div class="col-2-kembali">
                                    <p><a href="{{ route('karyawan') }}" class="btn btn-success"> Kembali</a></p>
                                </div>
                            </div>
                            <form method="post" action="{{ route('karyawan.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Karyawan *</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ old('nama') }}" required>
                                    @error('nama')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Akun *</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password Akun *</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    @error('password')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP *</label>
                                    <input type="number" class="form-control" id="nip" name="nip"
                                        value="{{ old('nip') }}" required>
                                    @error('nip')
                                        <div class="form-text text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="divisi" class="form-label">Divisi *</label>
                                    <select class="form-select" aria-label="Default select example" name="divisi"
                                        id="divisi" required>
                                        <option selected disabled>Pilih Divisi</option>
                                        @foreach ($data_divisi as $data)
                                            <option value="{{ $data->id_divisi }}"
                                                {{ old('divisi') == $data->id_divisi ? 'selected' : '' }}>
                                                {{ $data->deskripsi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('divisi')
                                        <div class="form-text text-danger">{{ $message }}</div>
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
