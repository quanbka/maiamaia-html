@extends('system.layouts.main')
@section('script')
<script src="/sys/js/controller/store-controller.js?v={{ config('app.version') }}" charset="utf-8"></script>
@endsection
@section('content')
<section class="content-header">
  <h1>
    Manage Store
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Manage Store</li>
  </ol>
</section>

<section class="content" ng-controller="StoreController">
    @include('system.store.filter')
    @include('system.store.list')
    @include('system.store.modal')
</section>

@endsection
