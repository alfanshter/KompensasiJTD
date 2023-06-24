<!DOCTYPE html>
<html lang="en">

<head>
@notifyCss

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Kompensasi JTD</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('vendors/mdi/css/materialdesignicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('vendors/css/vendor.bundle.base.css')}}" />
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" />
</head>

<body>
<x-notify::notify />
        @notifyJs
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <center>
                                <div class="brand-logo">
                                    <img src="{{asset('images/logopolinema.png')}}" />

                                </div>

                                <h4 class="txt txt-primary">Kompensasi JTD</h4>
                                <h6 class="font-weight-light">
                                    Silahkan Login
                            </center>
                            </h6>
                            @if (session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                            @endif

                            @if (session()->has('loginError'))
                            <div class="alert alert-danger" role="alert">
                                {{session('loginError')}}
                            </div>
                            @endif
                            <form class="pt-3" method="POST" action="/login">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" name="email" required placeholder="Email" />
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" required class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" />
                                </div>
                                <center>
                                    <div class="mt-3">
                                        <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" type="submit">Masuk</button>
                                    </div>
                                </center>

                                <div class="text-center mt-4 font-weight-light">
                                    Apakah anda belum punya akun ?
                                    <a href="/register" class="text-primary">Daftar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/misc.js')}}"></script>
    <!-- endinject -->
</body>

</html>