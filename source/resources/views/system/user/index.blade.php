@extends('system.layouts.main')
@section('script')
<script src="/sys/js/controller/user-controller.js?v={{ config('app.version') }}" charset="utf-8"></script>
@endsection
@section('content')
<section class="content-header">
  <h1>
    Quản lý Người dùng
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">Quản lý Người dùng</li>
  </ol>
</section>

<section class="content" ng-controller="UserController">
    @include('system.user.filter')
    @include('system.user.list')
    @include('system.user.modal')
</section>

@endsection
