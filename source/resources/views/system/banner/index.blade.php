@extends('system.layouts.main')
@section('css')
@endsection
@section('script')
<script type="text/javascript" src="/sys/js/angular/angular-resource.min.js?v={{ config('app.version') }}"></script>
<script type="text/javascript" src="/sys/js/angular/angular-file.js?v={{ config('app.version') }}"></script>
<script type="text/javascript" src="/sys/js/controller/banner-controller.js?v={{ config('app.version') }}"></script>
<script src="/sys/js/angular/ng-file-upload-shim.min.js"></script> 
<script src="/sys/js/angular/ng-file-upload.min.js"></script>
@endsection
@section('content')
<section class="content-header">
  <h1>
    Quản lý banner
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">Quản lý Banner</li>
  </ol>
</section>

<section class="content" ng-controller="BannerController">
  @include('system.banner.list')
  @include('system.banner.modal')
</section>
@endsection