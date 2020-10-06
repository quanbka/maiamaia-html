@extends('system.layouts.main')
@section('script')
<script src="/sys/js/controller/contact-controller.js?v={{ config('app.version') }}" charset="utf-8"></script>
@endsection
@section('content')
<section class="content-header">
  <h1>
    List Contact
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">List Contact</li>
  </ol>
</section>

<section class="content" ng-controller="ContactController">
    @include('system.contact.filter')
    @include('system.contact.list')
</section>

@endsection
