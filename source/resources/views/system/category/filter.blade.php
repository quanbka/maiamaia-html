<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><?= ucfirst(strtolower($typeCategory)) ?> Category</h3>
        <div class="pull-right box-tools">
            <button type="button" class="btn btn-success btn-sm" ng-click="showCreateCategoryForm()">
                <i class="fa fa-plus"></i>
                Create a new <?= strtolower($typeCategory) ?> category
            </button>
        </div>
    </div>
            <div class="box-body">

                    <from class="form-horizontal">

                        <div class="col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="control-label col-md-4">Name </label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" name="" value="" ng-model="filter.name" ng-keyup="$event.keyCode == 13 && getCategories()">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="control-label col-md-4">Status </label>
                                <div class="col-md-8">
                                    <select ng-model="filter.status"
                                            class="form-control"
                                            ng-options="status.value as status.name for status in statuses"
                                            ng-change="getCategories()">
                                        <option value="">All</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <button type="button" id="searchCategoryButton" class="btn btn-success search" ng-click="getCategories()" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."><i class="fa fa-search"></i> Search</button>
                            <button type="button" class="btn btn-warning btn-reset" ng-click="reset()"><i class="fa fa-times"></i> Reset</button>
                        </div>

                    </form>


            </div>
            <!-- /.box-body -->
          </div>
