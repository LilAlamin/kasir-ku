<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="/boostrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="/node_modules/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">


</head>

<body>
  @include('partials.navbar')

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <style>
                body {
                    font-family: 'Poppins', sans-serif;

                }
            </style>



            @yield('layout')

        </div>


    </div>

    <script src="/boostrap/js/bootstrap.min.js"></script>

</body>

</html>
