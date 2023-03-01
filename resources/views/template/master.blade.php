<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="_token" content="{{csrf_token()}}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    {{-- Plugin CSS --}}
    @yield('pluginCSS')

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('assets/css/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .laporan-count {
            background: red;
            color: white;
            padding: 2px 4px;
            border-radius: 7px;
            margin-left: 3px;
        }
    </style>

</head>

<body>

    <div class="modal fade" id="ResetPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Form Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success bg-success text-white border-0" role="alert" id="message_success" style="display:none;">
                    </div>
                    <div class="alert alert-danger bg-danger text-white border-0" role="alert" id="message_error" style="display:none;">
                    </div>
                    <form id="resetpassform" method="post" action="{{url('reset-password')}}">
                        @csrf
                        <input class="form-control" type="hidden" id="user_id" name="user_id" value="124">
                        <div class="form-group">
                            <label for="pass_old">Password Lama</label>
                            <input class="form-control" type="password" id="pass_old" name="pass_old" placeholder="Masukkan Password Lama" required>
                            <span id="old_pass_msg" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="pass_new">Password Baru</label>
                            <input class="form-control" type="password" id="pass_new" name="pass_new" placeholder="Masukkan Password Baru" required>
                            <span id="new_pass_msg" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="pass_new_con">Konfirmasi Password Baru</label>
                            <input class="form-control" type="password" id="pass_new_con" name="pass_new_con" placeholder="Masukkan Kembali Password Baru" required>
                            <span id="con_pass_msg" class="text-danger"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button id="submit_pass" type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- 9-11-2022 -->
    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-grow text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <!-- End Preloader-->

    <!-- Begin page -->
    <div id="wrapper">

        <!-- ========== Left Sidebar Start ========= -->
        <div class="left-side-menu">

            <!-- LOGO -->
            {{-- <div class="logo-box">
                    <a href="index.html" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="24">
            <span class="logo-lg-text-light">Highdmin</span>
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="22">
                <span class="logo-lg-text-light">H</span>
            </span>
            </a>

            <a href="index.html" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="24">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="22">
                </span>
            </a>
        </div> --}}

        <div class="h-100" data-simplebar>

            <!-- User box -->
            <div class="user-box text-center">
                <img src="{{ asset('assets/images/users/avatar-default.png') }}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
                <div class="dropdown">
                    <a href="javascript: void(0);" class="text-dark h5 mt-2 mb-1 d-block">@yield('nama')</a>
                </div>
                <p class="text-muted">@yield('jabatan')</p>
            </div>

            <!--- Sidemenu -->

            @if($jabatan == "Operator")
            <div id="sidebar-menu">

                <ul id="side-menu">

                    <li class="menu-title">Navigation</li>

                    <li><a href="{{ url('dashboard') }}"><i class="mdi mdi-view-dashboard"></i><span> Home </span></a></li>

                    <li class="menu-title mt-2">Master</li>

                    <li><a href="{{ url('aset') }}"><i class="mdi mdi-city"></i><span> Aset </span></a></li>


            </div>
            @endif


            @if($jabatan == "MANAJER")
            <div id="sidebar-menu">

                <ul id="side-menu">

                    <!-- Menu TMA Tebu -->
                    <li class="menu-title">Navigation</li>

                    <li><a href="{{ url('home') }}"><i class="mdi mdi-view-dashboard"></i><span> Home </span></a></li>

                    <li class="menu-title mt-2">TMA Tebu</li>

                    <li><a href="{{ url('tebu/datatebu') }}"><i class="mdi mdi-account-group"></i><span> data TMA Tebu </span></a></li>
                    <li class="menu-title mt-2">Master</li>
                    <li><a href="{{ url('master/harga/datatebu') }}"><i class="mdi mdi-cash-usd"></i><span> Master Tarif Tebang </span></a></li>
                    <li class="menu-title mt-2">Manajer</li>
                    <li><a href="{{ url('approve/datatebu') }}"><i class="mdi mdi-check-all"></i><span> Manajer To Do List </span></a></li>


                    <!--- Menu QC --->

                    <li class="menu-title mt-2">Quality Control Tebu</li>
                    <li><a href="{{ url('tebu/qcloses') }}"><i class="mdi mdi-account-details"></i><span> QC Loses </span></a></li>
                    <li><a href="{{ url('tebu/qcmbs') }}"><i class="mdi mdi-account-check"></i><span> QC MBS </span></a></li>

                    <li class="menu-title mt-2">Dashboard</li>

                    <li><a href="https://dashboard.ptpn12.com/action-login.php?3efb322dda34c1a7dbfb5da9742c3d06=d34b6c59ef0497d8ff246abd1049352e"><i class="mdi mdi-city"></i><span> Dashboard Produksi </span></a></li>

                </ul>

            </div>
            @endif

            @if($jabatan == "ADMIN KEBUN")
            <div id="sidebar-menu">

                <ul id="side-menu">

                    <!-- Menu TMA Tebu -->
                    <li class="menu-title">Navigation</li>

                    <li><a href="{{ url('home') }}"><i class="mdi mdi-view-dashboard"></i><span> Home </span></a></li>

                    <li class="menu-title mt-2">TMA Tebu</li>

                    <li><a href="{{ url('tebu/datatebu') }}"><i class="mdi mdi-account-group"></i><span> data TMA Tebu </span></a></li>
                    <li><a href="{{ url('tebu/adminedit/datatebu') }}"><i class="mdi mdi-account-edit"></i><span> Edit data TMA Tebu </span></a></li>
                    <li><a href="{{ url('tebu/datarenteng') }}"><i class="mdi mdi-account-group"></i><span> Master Renteng </span></a></li>
                    <li><a href="{{ url('tebu/datapta') }}"><i class="mdi mdi-account-group"></i><span> Master PTA </span></a></li>

                    <li><a href="{{ url('tebu/laporpg') }}"><i class="mdi mdi-account-alert"></i><span> Laporan PG </span>
                            @if (isset($countLaporan))
                            <span class="laporan-count">{{ $countLaporan }}</span>
                            @endif
                        </a></li>

                    <!--- Menu QC --->

                    <li class="menu-title mt-2">Quality Control Tebu</li>
                    <li><a href="{{ url('tebu/qcloses') }}"><i class="mdi mdi-account-details"></i><span> QC Loses </span></a></li>
                    <li><a href="{{ url('tebu/qcmbs') }}"><i class="mdi mdi-account-check"></i><span> QC MBS </span></a></li>

                    <li class="menu-title mt-2">Dashboard</li>

                    <li><a href="https://dashboard.ptpn12.com/action-login.php?3efb322dda34c1a7dbfb5da9742c3d06=d34b6c59ef0497d8ff246abd1049352e"><i class="mdi mdi-city"></i><span> Dashboard Produksi </span></a></li>

                </ul>

            </div>
            @endif
            @if($jabatan == "KASI" || $jabatan == "TANAMAN")
            <div id="sidebar-menu">

                <ul id="side-menu">

                    <!-- Menu TMA Tebu -->
                    <li class="menu-title">Navigation</li>

                    <li><a href="{{ url('home') }}"><i class="mdi mdi-view-dashboard"></i><span> Home </span></a></li>

                    <li class="menu-title mt-2">TMA Tebu</li>

                    <li><a href="{{ url('tebu/datatebu') }}"><i class="mdi mdi-account-group"></i><span> data TMA Tebu </span></a></li>

                    <li class="menu-title mt-2">Quality Control Tebu</li>
                    <li><a href="{{ url('tebu/qcloses') }}"><i class="mdi mdi-account-details"></i><span> QC Loses </span></a></li>
                    <li><a href="{{ url('tebu/qcmbs') }}"><i class="mdi mdi-account-check"></i><span> QC MBS </span></a></li>

                    <li class="menu-title mt-2">Dashboard</li>

                    <li><a href="https://dashboard.ptpn12.com/action-login.php?3efb322dda34c1a7dbfb5da9742c3d06=d34b6c59ef0497d8ff246abd1049352e"><i class="mdi mdi-city"></i><span> Dashboard Produksi </span></a></li>

                </ul>

            </div>
            @endif
            @if($jabatan == "DAUM")
            <div id="sidebar-menu">
                <ul id="side-menu">

                    <!-- Menu TMA Tebu -->
                    <li class="menu-title">Navigation</li>

                    <li><a href="{{ url('home') }}"><i class="mdi mdi-view-dashboard"></i><span> Home </span></a></li>

                    <li class="menu-title mt-2">TMA Tebu</li>

                    <li><a href="{{ url('tebu/datatebu') }}"><i class="mdi mdi-account-group"></i><span> data TMA Tebu </span></a></li>

                    <li class="menu-title mt-2">DAUM</li>

                    <li><a href="{{ url('tebu/daum/datatebu/') }}"><i class="mdi mdi-check-all"></i><span> Daum To Do List </span></a></li>

                    <li class="menu-title mt-2">Dashboard</li>

                    <li><a href="https://dashboard.ptpn12.com/action-login.php?3efb322dda34c1a7dbfb5da9742c3d06=d34b6c59ef0497d8ff246abd1049352e"><i class="mdi mdi-city"></i><span> Dashboard Produksi </span></a></li>

                </ul>
            </div>
            @endif
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <div class="container-fluid">

                <ul class="list-unstyled topnav-menu float-right mb-0">

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="{{ asset('assets/images/users/avatar-default.png') }}" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ml-1">
                                @yield('nama') <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                            <!-- item-->

                            <a href="#" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-outline"></i>
                                <span>Profil</span>
                            </a>
                            <a href="#" class="dropdown-item notify-item" data-toggle="modal" data-target="#ResetPass">
                                <i class="fa fa-key"></i>
                                <span>Reset Password</span>
                            </a>
                            <a href="{{ url('logout') }}" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list">
                        <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                            <i class="fe-settings noti-icon"></i>
                        </a>
                    </li>

                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="index.html" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="24">
                            <!-- <span class="logo-lg-text-light">Highdmin</span> -->
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="22">
                            <!-- <span class="logo-lg-text-light">H</span> -->
                        </span>
                    </a>

                    <a href="index.html" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="22">
                        </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <i class="fe-menu"></i>
                        </button>
                    </li>

                    <li>
                        <!-- Mobile menu toggle (Horizontal Layout)-->
                        <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                            <div class="lines">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </a>
                        <!-- End mobile menu toggle-->
                    </li>

                    <li>
                        <div class="page-title-box">
                            <h4 class="page-title">@yield('title')</h4>
                            @yield('breadcump')
                        </div>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->

        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page -->
                @yield('content')
                <!-- end page -->

            </div> <!-- container-fluid -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; Amanat12 Aplikasi Aset Manajemen N12 by <a href="ptpn12.com">PT Perkebunan Nusantara XII</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                <li class="nav-item">
                    <a class="nav-link py-2 active" data-toggle="tab" href="#settings-tab" role="tab">
                        <i class="mdi mdi-cog-outline d-block font-22 my-1"></i>
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content pt-0">
                <div class="tab-pane active" id="settings-tab" role="tabpanel">
                    <h6 class="font-weight-medium px-3 m-0 py-2 font-13 text-uppercase bg-light">
                        <span class="d-block py-1">Theme Settings</span>
                    </h6>

                    <div class="p-3">
                        <div class="alert alert-warning" role="alert">
                            <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                        </div>

                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="color-scheme-mode" value="light" id="light-mode-check" checked />
                            <label class="custom-control-label" for="light-mode-check">Light Mode</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="color-scheme-mode" value="dark" id="dark-mode-check" />
                            <label class="custom-control-label" for="dark-mode-check">Dark Mode</label>
                        </div>

                        <!-- Width -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="width" value="fluid" id="fluid-check" checked />
                            <label class="custom-control-label" for="fluid-check">Fluid</label>
                        </div>
                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="width" value="boxed" id="boxed-check" />
                            <label class="custom-control-label" for="boxed-check">Boxed</label>
                        </div>

                        <!-- Menu positions -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Menus Positon <small>(Leftsidebar and Topbar)</small></h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="menus-position" value="fixed" id="fixed-check" checked />
                            <label class="custom-control-label" for="fixed-check">Fixed</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="menus-position" value="scrollable" id="scrollable-check" />
                            <label class="custom-control-label" for="scrollable-check">Scrollable</label>
                        </div>

                        <!-- Left Sidebar-->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-color" value="light" id="light-check" checked />
                            <label class="custom-control-label" for="light-check">Light</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-color" value="dark" id="dark-check" />
                            <label class="custom-control-label" for="dark-check">Dark</label>
                        </div>

                        <!-- size -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-size" value="default" id="default-size-check" checked />
                            <label class="custom-control-label" for="default-size-check">Default</label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-size" value="condensed" id="condensed-check" />
                            <label class="custom-control-label" for="condensed-check">Condensed <small>(Extra Small size)</small></label>
                        </div>

                        <div class="custom-control custom-switch mb-1">
                            <input type="radio" class="custom-control-input" name="leftsidebar-size" value="compact" id="compact-check" />
                            <label class="custom-control-label" for="compact-check">Compact <small>(Small size)</small></label>
                        </div>

                        <!-- User info -->
                        <h6 class="font-weight-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

                        <div class="custom-control custom-switch mb-1">
                            <input type="checkbox" class="custom-control-input" name="leftsidebar-user" value="fixed" id="sidebaruser-check" />
                            <label class="custom-control-label" for="sidebaruser-check">Enable</label>
                        </div>

                    </div>

                </div>
            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    {{-- Plugin JS --}}
    @yield('pluginJS')

    <!-- App js -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
    </script>

    @yield('customJS')

</body>

</html>

<!-- test -->