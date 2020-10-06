@extends('system.layouts.main')
@section('script')
  <script src="/sys/js/controller/setting-controller.js?v={{ config('app.version') }}" charset="utf-8"></script>
@endsection
@section('content')
<section class="content-header">
  <h1>
    Setting
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Setting</li>
  </ol>
</section>

<section class="content" ng-controller="SettingController">
  @include('system.setting.filter')
  @include('system.setting.list')
</section>
@endsection