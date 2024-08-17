@extends('admin.master')
@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Column -->
                            <div class="col d-flex align-items-center">
                                <div>
                                    <h3>{{$dataKaryawan}}</h3>
                                    <p class="mb-0">
                                        Karyawan
                                    </p>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col d-flex align-items-center justify-content-end">
                                <div class="css-bar mb-0 css-bar-primary css-bar-20">
                                    <i class="ti ti-user-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Column -->
                            <div class="col d-flex align-items-center">
                                <div>
                                    <h3>{{$dataCutiDiproses}}</h3>
                                    <p class="mb-0">
                                        Pengajuan Diproses
                                    </p>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col d-flex align-items-center justify-content-end">
                                <div data-label="30%" class="css-bar mb-0 css-bar-warning css-bar-20">
                                    <i class="ti ti-file-search"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Column -->
                            <div class="col d-flex align-items-center">
                                <div>
                                    <h3>{{$dataCutiDiterima}}</h3>
                                    <p class="mb-0">Pengajuan Diterima</p>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col d-flex align-items-center justify-content-end">
                                <div data-label="40%" class="css-bar mb-0 css-bar-success css-bar-20">
                                    <i class="ti ti-file-like"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Column -->
                            <div class="col d-flex align-items-center">
                                <div>
                                    <h3>{{$dataCutiDitolak}}</h3>
                                    <p class="mb-0">Pengajuan Ditolak</p>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col d-flex align-items-center justify-content-end">
                                <div data-label="60%" class="css-bar mb-0 css-bar-danger css-bar-20">
                                    <i class="ti ti-file-dislike"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
