<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ isset($title)? $title : "MaiaMaia System" }}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="/sys/components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/sys/components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/sys/components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="/sys/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="/sys/dist/css/skins/skin-blue.min.css">
  <link rel="stylesheet" href="/sys/css/pnotify.custom.min.css">
  <link rel="stylesheet" href="/sys/dist/css/app.custom.css">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  @yield('css')
  <!-- jQuery 3 -->
  <script type="text/javascript">
      var api_domain = "{{ config('app.api_domain') }}";
      var api_token = "{{ Auth::user()->api_token }}";
      var cdn_url = "{{ config('app.cdn_base_url') }}" + "unsafe/0x0/left/top/smart/filters:quality(70)/" + api_domain + "/api/resources";
  </script>
  <script src="/sys/components/jquery/dist/jquery.min.js"></script>
  <script type="text/javascript" src="/sys/js/angular/angular.min.js"></script>
  <script type="text/javascript" src="/sys/js/angular/angular-sanitize.min.js"></script>
  <script type="text/javascript" src="/sys/js/angular/angular-animate.min.js"></script>
  <script type="text/javascript" src="/sys/js/angular/ng-file-upload.min.js"></script>
  <script type="text/javascript" src="/sys/js/angular/ng-file-upload-shim.min.js"></script>
  <script src="/sys/js/script/moment.js" charset="utf-8"></script>
  <script src="/sys/js/script/moment-timezone.js" charset="utf-8"></script>
  <script src="/sys/js/script/moment-timezone-with-data-2012-2022.min.js" charset="utf-8"></script>

  <script type="text/javascript" src="/sys/js/controller/system.js"></script>
  <script type="text/javascript" src="/sys/js/controller/base-controller.js"></script>
  <script type="text/javascript" src="/sys/js/controller/header-controller.js"></script>

  @yield('script')

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse" ng-app="system" ng-cloak="">
<div class="wrapper">

  @include('system.layouts.inc.header')
  @include('system.layouts.inc.sidebar')
  <!-- Left side column. contains the logo and sidebar -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
        @yield('content')
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
     Version:  <b>{{ config('app.version') }} </b>
    </div>
    <strong>Copyright &copy; 2018 <a href="http://megaads.vn/" target="_blank">MegaAds</a>.</strong> All rights
    reserved.
  </footer>



</div>
<!-- ./wrapper -->
@include('system.layouts.inc.footer-script')
<script type="text/javascript" src="/sys/js/script/pnotify.custom.min.js"></script>
@yield('footer-script')

</body>
</html>
