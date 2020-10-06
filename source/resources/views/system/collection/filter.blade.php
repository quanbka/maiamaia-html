<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Collection</h3>
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-success btn-xs" ng-click="showCreateCollectionForm()">
                <i class="fa fa-plus"></i>
                New Collection
            </button>
        </div>
    </div>
            <div class="box-body">
                    <from class="form-horizontal">
                        <div class="col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="control-label col-md-4 small">Name </label>
                                <div class="col-md-8">
                                    <input class="form-control input-sm" type="text" name="" value="" ng-model="filter.name" ng-keyup="$event.keyCode == 13 && getCategories()">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="control-label col-md-4">Status </label>
                                <div class="col-md-8">
                                    <select ng-model="filter.status"
                                            class="form-control input-sm"
                                            ng-options="status.value for status in statuses track by status.code"
                                            ng-change="getCategories()">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="clearfix"></div> -->
                        <!-- <div class="col-md-12 text-center"> -->
                            <button type="button" id="searchCategoryButton" class="btn btn-sm btn-success search" ng-click="getCategories()" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."><i class="fa fa-search"></i> Search</button>
                            <button type="button" class="btn btn-sm btn-warning btn-reset" ng-click="reset()"><i class="fa fa-times"></i> Reset</button>
                        <!-- </div> -->
                    </form>
            </div>
            <!-- /.box-body -->
          </div>
