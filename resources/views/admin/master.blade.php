<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title','<title>Dashboard</title>')
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{asset('assets/plugins/highlightjs/styles/darkula.css')}}">
    <link href="{{asset('assets/plugins/tables/css/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet"> -->
    <link href="{{asset('assets/css/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/waitMe.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/bootstrap-multiselect.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/image-uploader.min.css')}}" rel="stylesheet">
    <script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
    @yield('style-script')
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{route('dashboard')}}">
                    <!-- <b class="logo-abbr"><img src="{{asset('assets/images/zuni-logo.png')}}" alt=""> </b>
                    <span class="logo-compact"><img src="{{asset('assets/images/logo-compact.png')}}" alt=""></span> -->
                    <span class="brand-title">
                        <img src="{{asset('assets/images/mazephazelogo.png')}}" alt=""></br></br>
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">

                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown d-none d-md-flex">
                            <a href="javascript:void(0)" class="log-user" data-toggle="dropdown">
                                <span>{{Auth::user()->full_name}}</span> <i class="fa fa-angle-down f-s-14"
                                    aria-hidden="true"></i>
                            </a>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="{{asset('assets/images/mazephazelogo.png')}}" height="40" width="40" alt="">
                            </div>
                            <div class="drop-down dropdown-profile   dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <!-- <li>
                                            <a href="app-profile.html"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                        </li> -->
                                        <li><a href="{{ route('adminLogout') }}"><i class="icon-key"></i>
                                                <span>Logout</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="nk-sidebar">
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Users</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('users') }}">All Users</a></li>
                        </ul>
                    </li>
                     <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Settings</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('privacyPolicy') }}">Privacy Policy</a></li>
                            <li><a href="{{ route('helpSupport') }}">Help & Support</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
        <!--**********************************
            Content body start
        ***********************************-->
        @yield('content')
        <!--**********************************
            Content body end
        ***********************************-->
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="javascript:void(0)"> MazePhaze</a> <?= date('Y'); ?>
                </p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/js/toastr.min.js')}}"></script>
    <script src="{{asset('assets/js/waitMe.js')}}"></script>
    <script src="{{asset('assets/plugins/common/common.min.js')}}"></script>
    <script src="{{asset('assets/js/custom.min.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/styleSwitcher.js')}}"></script>
    <script src="{{asset('assets/plugins/highlightjs/highlight.pack.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/tables/js/datatable/dataTables.bootstrap4.min.js')}}"></script>
    <!-- <script src="{{asset('assets/plugins/tables/js/datatable-init/datatable-basic.min.js')}}"></script> -->
    <script src="{{asset('assets/js/bootstrap-multselect.js')}}"></script>
    <script src="{{asset('assets/js/image-uploader.min.js')}}"></script>
    <script>
    hljs.initHighlightingOnLoad();
    </script>
    <script>
    $('.input-images').imageUploader();
    (function($) {
        "use strict"

        new quixSettings({
            version: "light", //2 options "light" and "dark"
            layout: "vertical", //2 options, "vertical" and "horizontal"
            navheaderBg: "color_1", //have 10 options, "color_1" to "color_10"
            headerBg: "color_1", //have 10 options, "color_1" to "color_10"
            sidebarStyle: "full", //defines how sidebar should look like, options are: "full", "compact", "mini" and "overlay". If layout is "horizontal", sidebarStyle won't take "overlay" argument anymore, this will turn into "full" automatically!
            sidebarBg: "color_1", //have 10 options, "color_1" to "color_10"
            sidebarPosition: "static", //have two options, "static" and "fixed"
            headerPosition: "fixed", //have two options, "static" and "fixed"
            containerLayout: "wide", //"boxed" and  "wide". If layout "vertical" and containerLayout "boxed", sidebarStyle will automatically turn into "overlay".
            direction: "ltr", //"ltr" = Left to Right; "rtl" = Right to Left
            sidebarPosition: "fixed",
        });


    })(jQuery);
    </script>
    <script>
    $(document).ready(function() {
        var type = "{{ Session::get('alert') }}";
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    });
    </script>
<script>
$(document).ready(function(){
  $('.editor').each(function(e) {
    CKEDITOR.replace( this.id,{
      allowedContent : true,
    toolbar: 'Full',
    enterMode : CKEDITOR.ENTER_BR,
    shiftEnterMode: CKEDITOR.ENTER_P,
  });
  });
});
</script>
    @yield('extra-script')

</body>

</html>