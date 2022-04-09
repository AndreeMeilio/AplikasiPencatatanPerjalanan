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
    <title>JOURNEY PATH</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-4 mt-3 d-flex flex-column align-items-center justify-content-center">
                <h1><strong>JOURNEY PATH</strong></h1>
                <h6>Aplikasi Pencatatan Perjalanan</h6>
            </div>
            <div class="col-12 col-md-8 mt-3 d-flex align-items-center justify-content-center">
                <div class="my-3 ms-3 text-center">
                    @include('components/navbutton')
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 px-5 mb-3 text-center">
                @include('components.logs')
            </div>
            <div class="d-block d-md-none">
                <hr class="border border-2 border-dark">
            </div>
            <div class="col-12 col-md-8 px-5">
                <div class="tab-content" id="nav-tabContent">
                    @include('components/content-dashboard')
                    @include('components/content-perjalanan')
                    @include('components/content-form')
                </div>
            </div>
        </div>
    </div>
    <div class="pt-2 pb-2 bg-light" id="footer">
        <div class="container">
            <span class="float-start">Copyright&copy; 2022</span>
            <span class="float-end">Made With &hearts; By Andree Meilio Caniago</span>
        </div>
    </div>
    @include('components.content-detail-perjalanan')
    <script src="{{ asset('assets/js/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>
</html>
