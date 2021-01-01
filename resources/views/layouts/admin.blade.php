<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap material admin template">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    <title>{{ trans('panel.site_full_title') }}</title>
    
    <link rel="apple-touch-icon" href="{{ asset('assets/images/apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ session('login_data.hospital.favicon_url') }}">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('global/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/css/bootstrap-extend.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/site.min.css') }}">
    
    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('global/vendor/animsition/animsition.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/vendor/asscrollable/asScrollable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/vendor/switchery/switchery.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/vendor/waves/waves.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/vendor/toastr/toastr.min.css') }}">
    
    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('global/fonts/material-design/material-design.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/fonts/brand-icons/brand-icons.min.css') }}">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>
    
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    @yield('styles')
    
    <!-- Scripts -->
    <script src="{{ asset('global/vendor/breakpoints/breakpoints.js') }}"></script>
    <script>
      Breakpoints();
    </script>
  </head>
  <body class="animsition {{session('login_data.hospital.theme_skin')}}">
    <?php
    $theme_classes='navbar-inverse';
    if(session('login_data.hospital.theme')!=''){
      if(session('login_data.hospital.theme.skin_navbar_type')==false){
        $theme_classes='';
      }
      if(session('login_data.hospital.theme.skinnavbar')!='primary'){
        $theme_classes.=' bg-'.session('login_data.hospital.theme.skinnavbar').'-600';
      }
    }
    ?>
    <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega {{$theme_classes}}" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
          data-toggle="menubar">
          <span class="sr-only">Toggle navigation</span>
          <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
          data-toggle="collapse">
          <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <a href="{{ url('admin/dashboard') }}">
        <div class="navbar-brand navbar-brand-center site-gridmenu-toggle" data-toggle="gridmenu">
          <!-- <img class="navbar-brand-logo" src="{{ asset('assets/images/logo.png')}}" title="OCHS"> -->
          <span class="navbar-brand-text hidden-xs-down">
            <!-- <img class="navbar-brand-logo" src="{{ session('login_data.hospital.logo_url') }}" title="OCHS"> -->
            S S Tredig
          </span>
          <br>
          <!-- <span class="navbar-brand-tag hidden-xs-down" style="font-size: 12px;"></span> -->
        </div>
        </a>
      </div>
    
      <div class="navbar-container container-fluid">
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
          <!-- Navbar Toolbar -->
          <ul class="nav navbar-toolbar">
            <li class="nav-item hidden-float" id="toggleMenubar">
              <a class="nav-link" data-toggle="menubar" href="#" role="button">
                <i class="icon hamburger hamburger-arrow-left">
                  <span class="sr-only">Toggle menubar</span>
                  <span class="hamburger-bar"></span>
                </i>
              </a>
            </li>
          </ul>
          <!-- End Navbar Toolbar -->
    
          <!-- Navbar Toolbar Right -->
          <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
            <li class="nav-item dropdown">
              <a class="nav-link navbar-avatar" data-toggle="dropdown" href="#" aria-expanded="false"
                data-animation="scale-up" role="button">
                <span class="avatar avatar-online">
                  <img src="{{ asset('assets/images/default_user.png') }}" alt="...">
                  <i></i>
                </span>
                <span>Welcome, Admin</span>
              </a>
              <div class="dropdown-menu" role="menu">
                <a class="dropdown-item" href="javascript:void(0)" role="menuitem"><i class="icon md-account" aria-hidden="true"></i> Profile</a>
                <!--<div class="dropdown-divider"></div> 
                 <a href="javascript:void(0);" class="dropdown-item waves-effect waves-light waves-round"><span>{{ session('login_data.hospital.name')}}</span></a> -->
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item waves-effect waves-light waves-round" onclick="event.preventDefault(); document.getElementById('logoutform').submit();"><i class="icon md-power" aria-hidden="true"></i> {{ trans('global.logout') }}</a>
              </div>
            </li>
          </ul>
          <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
      </div>
    </nav>    
    
    @include('partials.menu')

    <!-- Page -->
    <div class="page">

      @yield('content')

      <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
          {{ csrf_field() }}
      </form>
    </div>
    <!-- End Page -->
    <div id="hms_loader">
      <div class="lds-dual-ring"></div>
    </div>
    <!-- Footer -->
    <footer class="site-footer">
      <div class="site-footer-legal">© {{ date('Y') }} All Rights Reserved</div>
      <div class="site-footer-right">
        Powered & Design <i class="red-600 icon md-favorite"></i> by <a href="http://www.letsenkindle.com/">Let's Enkindle</a>
      </div>
    </footer>
    <!-- Core  -->
    <script src="{{ asset('global/vendor/babel-external-helpers/babel-external-helpers.js')}}"></script>
    <script src="{{ asset('global/vendor/jquery/jquery.js')}}"></script>
    <script src="{{ asset('global/vendor/popper-js/umd/popper.min.js')}}"></script>
    <script src="{{ asset('global/vendor/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{ asset('global/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{ asset('global/vendor/mousewheel/jquery.mousewheel.min.js')}}"></script>
    <script src="{{ asset('global/vendor/asscrollbar/jquery-asScrollbar.min.js')}}"></script>
    <script src="{{ asset('global/vendor/asscrollable/jquery-asScrollable.min.js')}}"></script>
    <script src="{{ asset('global/vendor/ashoverscroll/jquery-asHoverScroll.min.js')}}"></script>
    <script src="{{ asset('global/vendor/waves/waves.min.js')}}"></script>

    <!-- Plugins -->
    <script src="{{ asset('global/vendor/switchery/switchery.min.js')}}"></script>
    <script src="{{ asset('global/vendor/toastr/toastr.min.js')}}"></script>
    
    <!-- Scripts -->
    <script src="{{ asset('global/js/Component.js')}}"></script>
    <script src="{{ asset('global/js/Plugin.js')}}"></script>
    <script src="{{ asset('global/js/Base.js')}}"></script>
    <script src="{{ asset('global/js/Config.js')}}"></script>

    <script src="{{ asset('assets/js/Section/Menubar.js')}}"></script>
    <script src="{{ asset('assets/js/Section/Sidebar.js')}}"></script>
    <script src="{{ asset('assets/js/Section/PageAside.js')}}"></script>
    <script src="{{ asset('assets/js/Plugin/menu.js')}}"></script>
    
    <!-- Config -->
    <script>Config.set('assets', '{{ asset("assets")}}');</script>

    <script type="text/javascript">
      var base_url = "{{ url('/') }}";
      var logged_user_email = "{{ session('login_data.user.email') }}";
      var developer_admin_email = "{{ config('config.developer_admin.email') }}";

      if (logged_user_email == developer_admin_email) {
        var is_admin = 1;
      }
      else {
          var is_admin = 0;
      }
    </script>
    
    <!-- Page -->
    <script src="{{ asset('assets/js/Site.js')}}"></script>
    <script src="{{ asset('global/js/Plugin/asscrollable.js')}}"></script>
    <script src="{{ asset('global/js/Plugin/switchery.js')}}"></script>
    <script src="{{ asset('assets/js/custom.js')}}"></script>
    <script>
    $(function(){
      @if(session('message'))
        toastrSuccess('','{{ session('message') }}');
      @endif
      @if($errors->count() > 0)
        var toster_msgs_arr='';
        @foreach($errors->all() as $error)
        toster_msgs_arr+='<li>{{ $error }}</li>';
        @endforeach
        toastrErrors(toster_msgs_arr,'Some fields are incorrect.');
      @endif

      if($('.site-menu-sub .site-menu-item').hasClass("active")){
        $activeMenu=$('.site-menu-sub').find('.site-menu-item.active').parent('.site-menu-sub').parent('.site-menu-item.has-sub');
        $activeMenu.addClass('active');
        $activeMenu.parent('.site-menu-sub').parent('.site-menu-item.has-sub').addClass('active');
      }
    });
    </script>
    @yield('scripts')
  </body>
</html>
