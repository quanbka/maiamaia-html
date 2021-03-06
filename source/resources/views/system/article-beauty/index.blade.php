@extends('system.layouts.main')
@section('css')
    <link rel="stylesheet" href="/sys/css/bootstrap-datepicker.css">
@endsection
@section('script')
    <script>
        var listCategory = <?= json_encode($listCategory); ?>;
    </script>
    <script src="/sys/js/script/bootstrap-datepicker.js?v={{ config('app.version') }}" charset="utf-8"></script>
    <script src="/sys/plugins/tinymce/tinymce.min.js?v={{ config('app.version') }}" charset="utf-8"></script>
    <script src="/sys/plugins/tinymce/tinymce.plugin.js?v={{ config('app.version') }}" charset="utf-8"></script>
    <script src="/sys/js/controller/article-beauty-controller.js?v={{ config('app.version') }}"
            charset="utf-8"></script>

@endsection
@section('content')
    <section class="content-header">
        <h1>
            Quản lý bài viết dịch vụ thẩm mỹ
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
            <li class="active">Quản lý bài viết dịch vụ thẩm mỹ</li>
        </ol>
    </section>

    <section class="content" ng-controller="ArticleBeautyController">
        @include('system.article-beauty.filter')
        @include('system.article-beauty.list')
        @include('system.article-beauty.modal')
    </section>
@endsection