@extends('admin.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/multi-dropdown.css') }}" />
@endsection

@section('admin')
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <!-- Page Heading -->
                <h5 class="card-title fw-semibold mb-4">Pengajuan Cuti</h5>
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
                                    <p><a href="{{ route('cuti') }}" class="btn btn-success"> Kembali</a></p>
                                </div>
                            </div>
                            <form method="post" action="{{ route('cuti.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="mulaiCuti" class="form-label">Mulai Cuti *</label>
                                    <input type="date" class="form-control" id="mulaiCuti" name="mulaiCuti">
                                    @error('mulaiCuti')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="akhirCuti" class="form-label">Akhir Cuti *</label>
                                    <input type="date" class="form-control" id="akhirCuti" name="akhirCuti">
                                    @error('akhirCuti')
                                        <small>{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan *</label>
                                    <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                                    @error('keterangan')
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
