<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Kompensasi JTD</title>
    @notifyCss

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
    <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('js/jquery.cookie.js')}}" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    {{--<script src="{{asset('js/dashboard.js')}}"></script>--}}
    <script src="{{asset('js/todolist.js')}}"></script>
    <!-- End custom js for this page -->

</head>

<body>
    <x-notify::notify />
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('layout.topbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            @include('layout.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper" style="background-image: url('/images/bgkuningsoft.jpg');">
                    @yield('konten')
                    <script>

                    </script>

                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer"  >
                    <div class="container-fluid d-flex justify-content-between">
                        <span class="text-muted d-block text-center text-sm-start d-sm-inline-block">Kompensasi JTD</span>
                        <span-- class="float-none float-sm-end mt-1 mt-sm-0 text-end">
                            {{--Free
                                <a
                                    href="https://www.bootstrapdash.com/bootstrap-admin-template/"
                                    target="_blank"
                                    >Bootstrap admin template</a
                                >
                                from Bootstrapdash.com</span--}}
                            >
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    {{--<!-- plugins:js -->
        <script src="{{asset('vendors/js/vendor.bundle.base.js')}}"></script>--}}
    <!-- endinject -->
    <!-- Plugin js for this page -->
    {{--<script src="{{asset('vendors/chart.js/Chart.min.js')}}"></script>--}}
    {{--<script
            src="{{asset('js/jquery.cookie.js')}}"
    type="text/javascript"
    ></script>--}}
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    {{--<script src="{{asset('js/off-canvas.js')}}"></script>
    <script src="{{asset('js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('js/misc.js')}}"></script>--}}
    <!-- endinject -->
    <!-- Custom js for this page -->
    {{--<script src="{{asset('js/dashboard.js')}}"></script>--}}
    {{--<script src="{{asset('js/todolist.js')}}"></script>--}}
    <!-- End custom js for this page -->
    @notifyJs

</body>

</html>