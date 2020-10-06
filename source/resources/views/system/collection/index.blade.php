@extends('system.layouts.main')
@section('css')
    <link rel="stylesheet" href="/sys/css/bootstrap-datepicker.css">
    <style>
      .text-link{
        cursor: pointer;
      }
    </style>
@endsection
@section('script')
    <script src="/sys/js/script/bootstrap-datepicker.js?v={{ config('app.version') }}" charset="utf-8"></script>
    <script src="/sys/js/controller/collection-controller.js?v={{ config('app.version') }}" charset="utf-8"></script>
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Manage Collection
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Manage Collection</li>
        </ol>
    </section>

    <section class="content" ng-controller="CollectionController">
        @include('system.collection.filter')
        @include('system.collection.list')
        @include('system.collection.modal')
    </section>

@endsection
