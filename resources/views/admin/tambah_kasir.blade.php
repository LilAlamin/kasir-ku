@extends('layouts.kasir')

@section('layout')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{-- @php
                    // Menggunakan helper session() untuk mengambil data dari sesi
                    $userId = session('user_id');

                    // Mendapatkan username berdasarkan user_id
                    $user = \App\Models\users::find($userId);
                    $userName = $user ? $user->username : null;
                @endphp
                <h3 style="font-family: 'Poppins',sans-serif;">Selamat Datang, {{ $userName }}</h3>
                <br> --}}
                <div class="card mt-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h6 class="card-title mb-0">Form Tambah Petugas Kasir</h6>
                    </div>

                    <div class="card-body">
                        <form action="{{ Route('admin.store_kasir') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="username" class="col-sm-2 col-form-label">Username:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Masukkan username">
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label for="password" class="col-sm-2 col-form-label">Password:</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Masukkan password">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                Lihat Password
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mt-2">
                                <label for="role" class="col-sm-2 col-form-label">Role:</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="role" name="user_type">
                                        <option value="kasir" selected>Kasir</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>


            </div>
        </div>
    </div>
    <style>
        .input-group-append {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
        }
    </style>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
    </script>
@endsection
