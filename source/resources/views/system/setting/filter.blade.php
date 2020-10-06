<div class="box box-solid">
    <!-- /.box-header -->
    <div class="box-body">
        <div class="col-md-6 col-lg-6">
            <div class="form-group">
                <label class="control-label col-md-3">Key </label>
                <div class="col-md-9">
                    <input class="form-control" type="text" ng-model="filter.key">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <button type="button" class="btn btn-success search" ng-click="find()" id="searchParamButton"
                    data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."><i class="fa fa-search"></i> Search
            </button>
            <button type="button" class="btn btn-warning btn-reset"
                    ng-click="reset()">
                <i class="fa fa-times"></i> Reset
            </button>
        </div>
    </div>
    <!-- /.box-body -->
</div>
