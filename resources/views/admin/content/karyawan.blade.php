@extends('admin.master')
@section('admin')
    <div class="container-fluid">
        <div class="d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                        <div class="mb-3 mb-sm-0">
                            <h4 class="card-title fw-semibold">Karyawan</h4>
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
                        <a href="{{ route('karyawan.create') }}" class="btn btn-primary ms-auto">Tambah</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col">Nama</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Sisa Cuti</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                @foreach ($data_karyawan as $data)
                                    <tr>
                                        <th>{{ $data->nama }}</th>
                                        <th>{{ $data->nip }}</th>
                                        <th>{{ $data->saldo_cuti }} Hari</th>
                                        <th style="width: 12%;">
                                            <a href="{{ route('karyawan.edit', ['id' => $data->id_pegawai]) }}"
                                                class="badge fw-semibold py-1 w-85 bg-secondary-subtle text-secondary">Ubah</a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#staticBackdrop{{ $data->id_pegawai }}"
                                                class="badge fw-semibold py-1 w-85 bg-danger-subtle text-danger">Hapus</a>
                                        </th>
                                    </tr>
                                    <div class="modal fade" id="staticBackdrop{{ $data->id_pegawai }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">>
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi
                                                        Hapus Data</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah kamu yakin ingin menghapus data user
                                                        <b>{{ $data->nama }}</b>
                                                    </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">

                                                    <form
                                                        action="{{ route('karyawan.delete', ['id' => $data->id_pegawai]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-default"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Ya,
                                                            Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
