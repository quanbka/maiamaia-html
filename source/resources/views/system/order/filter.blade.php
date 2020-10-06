<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Order</h3>
    </div>
    <div class="box-body">
        <form class="form-horizontal">

            <div class="col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="control-label col-md-4">From </label>
                    <div class="col-md-8">
                        <input type="text"
                               ng-model="filter.create_from"
                               class="form-control pull-right datepicker">
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="form-group">
                    <label class="control-label col-md-4">To </label>
                    <div class="col-md-8">
                        <input type="text"
                               ng-model="filter.create_to"
                               class="form-control pull-right datepicker">
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-md-12 text-center">
                <button type="button" id="searchOrder" class="btn btn-success search" ng-click="find()"
                        data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."><i
                            class="fa fa-search"></i> Search
                </button>
                <button type="button" class="btn btn-warning btn-reset" ng-click="reset()"><i class="fa fa-times"></i>
                    Reset
                </button>
            </div>

        </form>


    </div>
    <!-- /.box-body -->
</div>
<script>
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
    })
</script>
