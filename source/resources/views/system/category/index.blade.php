@extends('system.layouts.main')
@section('script')
<script src="/sys/js/controller/category-controller.js?v={{ config('app.version') }}" charset="utf-8"></script>
@endsection
@section('content')
    <script>
        var typeCategory = '<?= $typeCategory ?>';
    </script>
<section class="content-header">
  <h1>
    Quản lý danh mục
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">Quản lý danh mục</li>
  </ol>
</section>

<section class="content" ng-controller="CategoryController">
    @include('system.category.filter')
    @include('system.category.list')
    @include('system.category.modal')
</section>

@endsection
