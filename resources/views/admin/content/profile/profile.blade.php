@extends('admin.master')

@section('admin')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Informasi Profil</h5>
                        <p class="mb-4">Perbarui informasi profil dan alamat email akun Anda.</p>

                        @if (session('status') === 'profile-updated')
                            <div class="alert alert-success" role="alert">
                                Profil berhasil diperbarui.
                            </div>
                        @endif

                        <form method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', Auth::user()->name) }}" required autofocus>
                                @error('name')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email', Auth::user()->email) }}" required>
                                @error('email')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title fw-semibold mb-4">Ubah Password</h5>
                        <p class="mb-4">Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
                        </p>

                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success" role="alert">
                                Password berhasil diperbarui.
                            </div>
                        @endif

                        <form method="post" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Password Saat Ini</label>
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    required>
                                @error('current_password', 'updatePassword')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                                @error('password', 'updatePassword')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                                @error('password_confirmation', 'updatePassword')
                                    <div class="form-text text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Hide success message after 5 seconds
        document.addEventListener("DOMContentLoaded", function() {
            const alerts = document.querySelectorAll('.alert-success');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    alert.style.display = 'none';
                }, 5000);
            });
        });
    </script>
@endpush
