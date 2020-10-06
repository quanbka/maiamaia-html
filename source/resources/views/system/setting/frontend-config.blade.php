@extends('system.layouts.main')
@section('script')
    <script src="/sys/js/controller/setting-frontend-config-controller.js?v={{ config('app.version') }}" charset="utf-8"></script>
@endsection
@section('content')
    <section class="content-header">
        <h1>
            Frontend Setting
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Frontend Setting</li>
        </ol>
    </section>

    <section class="content" ng-controller="SettingFrontendConfigController">
        <div class="row">
            <div class="col-lg-12">




            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Config sidebar store info</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal">
                        @for ($i=0; $i < 3; $i++)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Banner {{$i+1}}</label>

                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" ng-model="storeWidgetConfig[{{$i}}].banner_url">
                                            <span class="input-group-btn"
                                            ngf-select="upload($file, storeWidgetConfig[{{$i}}])"
                                            ngf-accept="'image/*'"
                                            ngf-max-size="20MB"
                                            ngf-pattern="'image/*'">
                                            <button type="button" class="btn btn-default btn-flat"><i class="fa fas fa-camera"></i></button>
                                        </span>

                                    </div>
                                    <div class="" style="padding: 10px;">

                                        <img  style="max-width: 100%; max-height: 40px;" ng-src="{{storeWidgetConfig[<?php echo($i); ?>].banner_url}}" alt="">
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Link {{$i+1}}</label>

                                    <div class="col-sm-9">
                                        <input type="text" rows="3" cols="80"  class="form-control" ng-model="storeWidgetConfig[{{$i}}].description"/>
                                    </div>
                                </div>
                                <hr>
                            </div>

                        @endfor

                    </form>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right" ng-click="updateStoreWidget()">Save</button>
                </div>

            </div>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Config sidebar store info</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal">
                        @for ($i=0; $i < 1; $i++)
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Banner {{$i+1}}</label>

                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" ng-model="storeWidgetConfig[{{$i}}].banner_url">
                                            <span class="input-group-btn"
                                            ngf-select="upload($file, storeWidgetConfig[{{$i}}])"
                                            ngf-accept="'image/*'"
                                            ngf-max-size="20MB"
                                            ngf-pattern="'image/*'">
                                            <button type="button" class="btn btn-default btn-flat"><i class="fa fas fa-camera"></i></button>
                                        </span>

                                    </div>
                                    <div class="" style="padding: 10px;">

                                        <img  style="max-width: 100%; max-height: 40px;" ng-src="{{storeWidgetConfig[<?php echo($i); ?>].banner_url}}" alt="">
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Link {{$i+1}}</label>

                                    <div class="col-sm-9">
                                        <input type="text" rows="3" cols="80"  class="form-control" ng-model="storeWidgetConfig[{{$i}}].description"/>
                                    </div>
                                </div>
                                <hr>
                            </div>

                        @endfor

                    </form>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right" ng-click="updateStoreWidget()">Save</button>
                </div>

            </div>

        </div>
    </div>
    <script src="/sys/plugins/tinymce/tinymce.min.js" charset="utf-8"></script>
    <script src="/sys/js/angular/angular-tinymce.js" charset="utf-8"></script>
    <style media="screen">
        body.mce-content-body  {
           background-color: :#333 !important;
           color:#888 !important;
        }
    </style>



</section>
@endsection
