<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir-Ku</title>
    <link rel="stylesheet" href="/boostrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Poppins',sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            width: 400px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h5 class="card-title text-center fw-bold ">Kasir-Ku</h5>
        <hr>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group ">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter username">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-primary mt-2" type="submit">Login</button>
              </div>
        </form>
    </div>

    <script src="/boostrap/js/bootstrap.min.js"></script>
</body>
</html>
