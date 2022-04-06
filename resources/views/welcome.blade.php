<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <title>PEDULI DIRI</title>
</head>

<body>
    <div class="container flex-column align-items-stretch">
        <nav class="navbar navbar-expand-lg navbar-transparant bg-transparant">
            <div class="container-fluid mt-3 mb-5">
                <a class="navbar-brand text-dark fs-3" href="#"><strong>YOURNEY</strong></a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <button class="btn btn-success me-3 px-4" data-bs-toggle="modal" data-bs-target="#modal_login" id="btn_login">Login</button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_register" id="btn_register">Register</button>
                </div>  
            </div>
        </nav>
        <div class="row">
            <div class="col-6  d-flex align-items-stretch">
                <img class="img-fluid" width="75%" src="{{ asset('assets/image/Globalization-pana.png') }}" alt="">
            </div>
            <div class="col-6 d-flex justify-content-center align-items-center">
                <div class="fs-1 fw-bold text-center" id="txtLandingPage"></div>
            </div>
        </div>
    </div>

    @include('components.modal_register')
    @include('components.modal_login')

    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/auth.js') }}"></script>
</body>

</html>
