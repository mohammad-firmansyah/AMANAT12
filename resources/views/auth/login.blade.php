<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In AMANAT12 </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{ asset('assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="auth-fluid-pages loading pb-0">

    <div class="auth-fluid" style="background-image: url({{ asset('assets/images/bg-aset2.jpg') }});">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div>
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center">
                        <div class="auth-logo">
                            <a href="index.html" class="logo auth-logo-dark">
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-amanat-trans.png') }}" alt="" height="160">
                                </span>
                            </a>

                            <a href="index.html" class="logo auth-logo-light">
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo.png') }}" alt="" height="160">
                                </span>
                            </a>
                        </div>
                    </div>

                    <!-- title-->
                    <div class="text-center pt-0">
                        <h4 class="mt-0">AMANAT 12</h4>
                        <p class="text-muted mb-4">Aplikasi Aset Manajemen N12.</p>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger bg-danger text-white border-0" role="alert">
                        {!! $errors->first() !!}
                    </div>
                    @endif

                    @if (Session::has('message'))
                    <div class="alert alert-warning bg-warning text-white border-0" role="alert">
                        {!! Session::get('message') !!}
                    </div>
                    @endif

                    <!-- form -->
                    <form action="{{url('login')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="username">Username / NIP</label>
                            <input class="form-control" type="text" id="username" name="username" required="" placeholder="Masukkan username">
                        </div>
                        <div class="form-group">
                            {{-- <a href="pages-recoverpw.html" class="text-muted float-right"><small>Forgot your password?</small></a> --}}
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password">
                        </div>

                        <div class="form-group mb-3">
                            <div class="custom-control custom-checkbox"></div>
                        </div>
                        <div class="form-group mb-0 text-center">
                            <button class="btn btn-primary btn-block" type="submit">Log In </button>
                        </div>

                        <div class="text-center mt-4">
                            {{-- <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-dark ml-1">Sign Up</a></p> --}}
                        </div>
                    </form>
                    <!-- end form-->

                    <!-- Footer-->

                </div> <!-- end .card-body -->
            </div>
        </div>

        <!-- end auth-fluid-form-box-->

    </div>
    <!-- end auth-fluid-->

   
    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

</body>

</html>