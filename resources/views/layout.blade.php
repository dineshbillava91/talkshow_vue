<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Talkshow</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="/plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="{{ mix('/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/fontawesome-all.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/fullcalendar.min.css') }}" rel="stylesheet">
</head>

<style>

.logo-icon {
    color: #000;
    font-size: 30px;
    font-weight: bold;
    padding: 0px 20px;
}
.logout{
    padding-right: 20px;
    font-weight: bold;
    color: #fff;
}
.logout:hover{
    color: #2cabe3;
}
</style>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.html">
                        <!-- Logo icon -->
                        <strong class="logo-icon">
                            <!-- Dark Logo icon -->
                            Talkshow
                        </strong>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                   
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ms-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block me-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="#">
                                <span class="text-white font-medium">{{ Auth::user()->name }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                <i class="fa fa-power-off"></i>
                            </a>    
                            <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                    @if(Auth::check() && Auth::user()->role_id == '1') 
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('talks') }}"
                                aria-expanded="false">
                                <i class="fa fa-headphones" aria-hidden="true"></i>
                                <span class="hide-menu">Talks</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('speaker') }}"
                                aria-expanded="false">
                                <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                <span class="hide-menu">Speaker</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('event') }}"
                                aria-expanded="false">
                                <i class="fa fa-calendar-check" aria-hidden="true"></i>
                                <span class="hide-menu">Event</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('tag') }}"
                                aria-expanded="false">
                                <i class="fa fa-tag" aria-hidden="true"></i>
                                <span class="hide-menu">Tag</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('rating') }}"
                                aria-expanded="false">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <span class="hide-menu">Rating</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('top_speaker') }}"
                                aria-expanded="false">
                                <i class="fas fa-trophy" aria-hidden="true"></i>
                                <span class="hide-menu">Top Speakers</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('sameday_talks') }}"
                                aria-expanded="false">
                                <i class="fas fa-chart-line" aria-hidden="true"></i>
                                <span class="hide-menu">Sameday Talks</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('event_talks') }}"
                                aria-expanded="false">
                                <i class="fas fa-chart-line" aria-hidden="true"></i>
                                <span class="hide-menu">Talks Per Event</span>
                            </a>
                        </li>
                        @endif

                        @if(Auth::check() && Auth::user()->role_id == '2')
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('participants') }}"
                                aria-expanded="false">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="hide-menu">Participant</span>
                            </a>
                        </li>
                        @endif
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->

        @yield ('content')
        @php($year=date('Y'))

                    <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> {{ $year }} © Talkshow
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ mix('/js/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ mix('/js/bootstrap.min.js') }}"></script>
    <script src="{{ mix('/js/app-style-switcher.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ mix('/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ mix('/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ mix('/js/custom.js') }}"></script>
    <!--This page JavaScript -->
    <script src="{{ mix('/js/select2.min.js') }}"></script>

    <script>
    $('#speaker_id').select2({
        placeholder: 'Select Speaker',
        selectOnClose: false
    });

    $('#events').select2({
        placeholder: 'Select an Event',
        selectOnClose: false
    });

    $('#participants').select2({
        placeholder: 'Select Participants',
        selectOnClose: false
    });

    $('#tags').select2({
        placeholder: 'Select Tags',
        selectOnClose: false
    });

    @error('rating_id')
        $('#ratingModal').modal('show');
    @enderror
    
    window.csrf_token = "{{ csrf_token() }}"
    </script>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>

</html>