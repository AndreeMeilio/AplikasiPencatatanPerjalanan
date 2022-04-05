<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/loading/loading.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <title>YOURNEY</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-4 mt-3 d-flex align-items-center justify-content-center">
                <img class="img-fluid w-25" src="{{ asset('assets/image/logosementara.png') }}"
                    alt="Logo sementara dari aplikasi peduli diri">
            </div>
            <div class="col-8 mt-3 d-flex align-items-center">
                <div class="my-3">
                    <h2><strong>PEDULI DIRI</strong></h2>
                    <h6>Catatan Perjalanan</h6>
                    @include('components/navbutton')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4 px-5 text-center">
                @include('components.logs')
            </div>
            <div class="col-8 pe-5">
                <div class="tab-content" id="nav-tabContent">
                    @include('components/content-dashboard')
                    @include('components/content-perjalanan')
                    @include('components/content-form')
                </div>
            </div>
        </div>
    </div>
    @include('components.content-detail-perjalanan')

    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
