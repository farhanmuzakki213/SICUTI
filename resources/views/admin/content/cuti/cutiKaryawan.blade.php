@extends('admin.master')
@section('admin')
    <div class="container-fluid">
        <div class="d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                        <div class="mb-3 mb-sm-0">
                            @if (auth()->user()->roles->pluck('name')->implode(', ') == 'employee')
                                <h4 class="card-title fw-semibold">Data Pengajuan Cuti</h4>
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
                            @else
                                <h4 class="card-title fw-semibold">Data Cuti Karyawan</h4>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col">Nama Karyawan</th>
                                    <th scope="col">Lama Cuti</th>
                                    <th scope="col">Tanggal Mulai Cuti</th>
                                    <th scope="col">Tanggal Akhir Cuti</th>
                                    @if (auth()->user()->roles->pluck('name')->implode(', ') == 'employee')
                                        <th scope="col">Sisa Cuti</th>
                                    @endif
                                    @if (auth()->user()->roles->pluck('name')->implode(', ') != 'employee')
                                        <th scope="col">Status Cuti</th>
                                    @else
                                        <th scope="col">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                @foreach ($dataCutiKaryawan as $data)
                                    <tr>
                                        <th>{{ $data->r_pegawai->nama }}</th>
                                        <th>{{ $data->workDaysTotal }} Hari</th>
                                        <th>{{ $data->tgl_mulai_cuti }}</th>
                                        <th>{{ $data->tgl_akhir_cuti }}</th>
                                        @if (auth()->user()->roles->pluck('name')->implode(', ') == 'employee')
                                            <th>
                                                {{ $data->r_pegawai->saldo_cuti }} Hari
                                            </th>
                                            @if ($data->s_staff == 'Diajukan')
                                                <th>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#staticBackdrop{{ $data->id_cuti }}"
                                                        class="badge fw-semibold py-1 w-85 bg-secondary-subtle text-secondary"
                                                        style="cursor: pointer;">Hapus</a>
                                                </th>
                                            @elseif($data->s_staff == 'Ditolak' || $data->s_assistent == 'Ditolak' || $data->s_manager == 'Ditolak')
                                                <th>
                                                    <a
                                                        class="badge fw-semibold py-1 w-85 bg-danger-subtle text-danger">Ditolak</a>
                                                </th>
                                            @elseif ($data->s_manager == 'Diterima')
                                                <th>
                                                    <a
                                                        class="badge fw-semibold py-1 w-85 bg-success-subtle text-success">Diterima</a>
                                                </th>
                                            @else
                                                <th>
                                                    <a class="badge fw-semibold py-1 w-85 bg-primary-subtle text-primary">Diproses</a>
                                                </th>
                                            @endif
                                        @else
                                            @if ($statusColumn)
                                                @if ($data->$statusColumn == 'Diajukan')
                                                    <th>
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#terima{{ $data->id_cuti }}"
                                                            class="badge fw-semibold py-1 w-85 bg-success-subtle text-success"
                                                            style="cursor: pointer;">Terima</a>
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#tolak{{ $data->id_cuti }}"
                                                            class="badge fw-semibold py-1 w-85 bg-danger-subtle text-danger"
                                                            style="cursor: pointer;">Tolak</a>
                                                    </th>
                                                @else
                                                    @if ($data->$statusColumn == 'Diterima')
                                                        <th>
                                                            <a
                                                                class="badge fw-semibold py-1 w-85 bg-success-subtle text-success">Terima</a>
                                                        </th>
                                                    @else
                                                        <th>
                                                            <a
                                                                class="badge fw-semibold py-1 w-85 bg-danger-subtle text-danger">Tolak</a>
                                                        </th>
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    </tr>
                                    {{-- Modal Hapus --}}
                                    <div class="modal fade" id="staticBackdrop{{ $data->id_cuti }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi
                                                        Hapus Data</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah kamu yakin ingin menghapus data cuti anda
                                                        <b>{{ $data->r_pegawai->nama }}</b>
                                                    </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">

                                                    <form action="{{ route('cuti.delete', ['id' => $data->id_cuti]) }}"
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
                                    {{-- Modal Update Status Diterima --}}
                                    <div class="modal fade" id="terima{{ $data->id_cuti }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="terima" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title fs-5" id="terima">Konfirmasi
                                                        Ubah Status</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah kamu yakin ingin memberikan izin cuti
                                                        <b>{{ $data->r_pegawai->nama }}</b>
                                                    </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">

                                                    <form action="{{ route('cuti.update', ['id' => $data->id_cuti]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" id="status"
                                                            value="Diterima">
                                                        <button type="button" class="btn btn-default"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Ya,
                                                            Terima</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Modal Update Status Ditolak --}}
                                    <div class="modal fade" id="tolak{{ $data->id_cuti }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="tolakLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title fs-5" id="tolakLabel">Konfirmasi
                                                        Ubah Status</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah kamu yakin tidak memberikan izin cuti
                                                        <b>{{ $data->r_pegawai->nama }}</b>
                                                    </p>
                                                </div>
                                                <div class="modal-footer justify-content-between">

                                                    <form action="{{ route('cuti.update', ['id' => $data->id_cuti]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" id="status"
                                                            value="Ditolak">
                                                        <button type="button" class="btn btn-default"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Ya,
                                                            Tolak</button>
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
