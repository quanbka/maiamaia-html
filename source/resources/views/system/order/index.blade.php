@extends('system.layouts.main')
@section('css')
    <link rel="stylesheet" href="/sys/css/bootstrap-datepicker.css">
@endsection
@section('script')
<script src="/sys/js/script/bootstrap-datepicker.js?v={{ config('app.version') }}" charset="utf-8"></script>
<script src="/sys/js/controller/order-controller.js?v={{ config('app.version') }}" charset="utf-8"></script>
@endsection
@section('content')
<section class="content-header">
  <h1>
    Manage Order
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Manage Order</li>
  </ol>
</section>

<section class="content" ng-controller="OrderController">
    @include('system.order.filter')
    @include('system.order.list')
    @include('system.order.modal')
</section>

@endsection

