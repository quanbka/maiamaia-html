<div class="box box-solid">
    <div class="box-body">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label col-md-3">Acount </label>
                <div class="col-md-9">
                    <input class="form-control" type="text" ng-model="filter.search_user">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label col-md-4">Date </label>
                <div class="col-md-8">
                    <input type="text"
                           ng-model="filter.date"
                           class="form-control pull-right datepicker">
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-5" style="margin-top: 10px">
            <button type="button" class="btn btn-success search" ng-click="find()" id="searchParamButton"
                    data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."><i class="fa fa-search"></i> Search
            </button>
            <button type="button" class="btn btn-warning btn-reset"
                    ng-click="reset()">
                <i class="fa fa-times"></i> Reset
            </button>
        </div>
    </div>
</div>
<script>
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy'
    });
</script>