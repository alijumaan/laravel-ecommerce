<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Ali Jumaan">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Cart White') }} - Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- CSS Files -->
    <link href="{{ asset('backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('backend/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @yield('style')
    @livewireStyles
</head>

<body id="page-top">
<div id="">
    <!-- Page Wrapper -->
    <div id="wrapper">

    @include('backend.layouts.sidebar')

    <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

        @include('backend.layouts.header')

        <!-- Main Content -->
            <div id="content">
                <div class="container-fluid">
                    @include('messages.flash')
                    @yield('content')
                </div>
            </div>
        <!-- End of Main Content -->

        <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        <a href="https://alijumaan.com">www.alijumaan.com</a>
                    </div>
                </div>
            </footer>
        <!-- End of Footer -->

        </div>

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

</div>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to leave?</h5>
            </div>
            <div class="modal-body">If you are sure you want to end the session, press the Exit button</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary"
                   href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault();
             document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Logout Modal-->
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('backend/js/sb-admin-2.min.js') }}"></script>

<script src="{{ asset('backend/js/alert-message.js') }}"></script>

@yield('script')
@livewireScripts
</body>
</html>
