<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Store</h3>
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-success btn-sm" ng-click="openCreateOrUpdateDialog('create',null)">
                <i class="fa fa-plus"></i>
                Create a new store
            </button>
        </div>
    </div>
            <div class="box-body">

                    <from class="form-horizontal">

                        <div class="col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="control-label col-md-4">Name </label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="" value="" ng-model="filter.name" ng-keyup="$event.keyCode == 13 && find()">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="control-label col-md-4">Status </label>
                                <div class="col-md-8">
                                    <select ng-model="filter.status"
                                            class="form-control"
                                            ng-options="status.code as status.name for status in statuses"
                                            ng-change="find()">
                                        <option value="">All</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>


                        <div class="col-md-12 text-center">
                            <button type="button" id="searchStoreButton" class="btn btn-success search" ng-click="find()" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."><i class="fa fa-search"></i> Search</button>
                            <button type="button" class="btn btn-warning btn-reset" ng-click="reset()"><i class="fa fa-times"></i> Reset</button>
                        </div>

                    </form>


            </div>
            <!-- /.box-body -->
          </div>
