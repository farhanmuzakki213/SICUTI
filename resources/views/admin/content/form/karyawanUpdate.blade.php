@extends('admin.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/multi-dropdown.css') }}" />
@endsection

@section('admin')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- Page Heading -->
                <h5 class="card-title fw-semibold mb-4">Ubah Data Karyawan </h5>
                <div class="container-fluid">
                    <!-- Form Ubah Data -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row justify-content-end">
                                <div class="col-2-kembali">
                                    <p><a href="{{ route('karyawan') }}" class="btn btn-success"> Kembali</a></p>
                                </div>
                            </div>
                            <form method="post" action="{{ route('karyawan.update', ['id' => $data_karyawan->id_pegawai]) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="divisi" class="form-label">Divisi *</label>
                                    <select class="form-select" aria-label="Default select example" name="divisi"
                                        id="divisi" required>
                                        <option selected disabled>Pilih Divisi</option>
                                        @foreach ($data_divisi as $data)
                                            <option value="{{ $data->id_divisi }}"
                                                {{ $data->id_divisi == $data_karyawan->divisi_id ? 'selected' : '' }}>
                                                {{ $data->nama_divisi }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('divisi')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Karyawan *</label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="{{$data_karyawan->nama}}">
                                    @error('nama')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP *</label>
                                    <input type="number" class="form-control" id="nip" name="nip" value="{{$data_karyawan->nip}}">
                                    @error('nip')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status *</label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status" id="aktif"
                                            value="aktif"
                                            {{ old('status', $data_karyawan->status) == 'aktif' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="aktif">Aktif</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status"
                                            id="non-aktif" value="non-aktif"
                                            {{ old('status', $data_karyawan->status) == 'non-aktif' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="non-aktif">Non-aktif</label>
                                    </div>
                                    @error('status')
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
