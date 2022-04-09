<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <title>JOURNEY PATH</title>
</head>
<body>
    <div class="container flex-column align-items-stretch">
        <nav class="navbar navbar-expand-lg navbar-transparant bg-transparant">
            <div class="container-fluid mt-3 mb-3">
                <a class="navbar-brand text-dark fs-3" href="#"><strong>JOURNEY PATH</strong></a>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <button class="btn btn-success me-3 px-4" data-bs-toggle="modal" data-bs-target="#modal_login"
                        id="btn_login">Login</button>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_register"
                        id="btn_register">Register</button>
                </div>
            </div>
        </nav>
        <div class="row mt-5">
            <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                <div class="fs-2 d-flex flex-row fw-bold text-center">Rekap Perjalanan Mu</div>
                <div class="fs-4 d-flex flex-row text-center">Catat Kemana Dan Apa Saja Perjalanan Hebat Yang Telah Kamu
                    Lakukan</div>
            </div>
            <div class="col-4  d-flex align-items-stretch">
                <img class="img-fluid" width="100%" src="{{ asset('assets/image/Globalization-pana.png') }}"
                    alt="">
            </div>
            <div class="col-4 d-flex flex-column justify-content-center align-items-center">
                <div class="fs-2 d-flex flex-row fw-bold text-center">Unduh Data Perjalanan</div>
                <div class="fs-4 d-flex flex-row text-center">Unduh Data Perjalananmu Kedalam Format Data Excel Kemudian Bagikan</div>
            </div>
        </div>
    </div>
    <div class="pt-2 pb-2 bg-light" id="footer">
        <div class="container">
            <span class="float-start">Copyright&copy; 2022</span>
            <span class="float-end">Made With &hearts; By Andree Meilio Caniago</span>
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
