<style>
    body{
        font-family: 'Poppins',sans-serif;

    }
 </style>
<nav class="navbar navbar-expand-lg bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
        <img src="{{ asset('img/store.png') }}" alt="" style="width: 40px;">
        Kasir-Ku
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav" >
        <ul class="navbar-nav">
            @php
            // Menggunakan helper session() untuk mengambil data dari sesi
            $userId = session('user_id');

            // Mendapatkan username berdasarkan user_id
            $user = \App\Models\users::find($userId);
            $user_type = $user ? $user->user_type : null;
            @endphp
            @if($user_type == 'admin')
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ Route('admin.index') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ Route('admin.produk') }}">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ Route('admin.kasir') }}">Kasir</a>
                </li>
                <li class="nav-item" style="margin-left: 68pc;">
                    <a class="nav-link active" aria-current="page" href="/logout">Logout</a>
                </li>
                @endif
                <li class="nav-item" style="margin-left: 80pc;">
                    <a class="nav-link active" aria-current="page" href="/logout">Logout</a>
                </li>
        </ul>
    </div>

    </div>
  </nav>
