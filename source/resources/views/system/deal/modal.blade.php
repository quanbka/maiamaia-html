<style media="screen">
.preview-deal-container{
    padding: 10px;
    width: 100%;
    height: 112px;
    text-align: left;
}
.preview-deal-img{
    max-width: 100%;
    max-height: 102px;

}
@media (min-width:1240px){
    .modal-lg{
        width: 1200px ;
    }
}
</style>


<div id="createDealForm" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create new deal</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#create_tab_1" data-toggle="tab">Create</a></li>
                            <li><a href="#create_tab_2" data-toggle="tab">Config</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="create_tab_1">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Type</label>
                                            <div class="col-sm-9">
                                                <select ng-model="newDeal.type"
                                                class="form-control"
                                                ng-options="type.name as type.display_name for type in types">
                                                    <option value="" disabled>Please select type of the deal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Deal title" ng-model="newDeal.title" ng-change="onChangeDealName()">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Cashback rate</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" ng-model="newDeal.cash_back_rate">
                                                    <span class="input-group-addon">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Store</label>
                                                <div class="col-sm-9">
                                                    <select ng-model="newDeal.store_id"
                                                    class="form-control"
                                                    ng-options="store.id as store.name for store in allStores">
                                                    <option value="" disabled>Please select store</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Published at</label>
                                            <div class="col-sm-9">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker" ng-model="newDeal.published_at">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Expired at</label>
                                            <div class="col-sm-9">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker" ng-model="newDeal.expired_at">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea type="text" class="form-control" placeholder="" ng-model="newDeal.description" rows="4" ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Coupon code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="A1B2C3" ng-model="newDeal.coupon_code">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Order</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="The bigger number, the higher deal stand." ng-model="newDeal.sorder">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Origin Url</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="http://" ng-model="newDeal.origin_url">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Affiliate Url</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="http://" ng-model="newDeal.affiliate_url">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Status</label>
                                            <div class="col-sm-3">
                                                <select ng-model="newDeal.status"
                                                class="form-control"
                                                ng-options="status.value as status.name for status in statuses">
                                                    <option value="" disabled>Please select status</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="checkbox" id="id-hot-deal-edit" ng-model="newDeal.is_hot_deal" ng-checked="newDeal.is_hot_deal == 1" ng-true-value="1" ng-false-value="0">
                                                <label for="id-hot-deal-edit" class="control-label">Is hot deal</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
            <!-- /.tab-pane -->
                            <div class="tab-pane" id="create_tab_2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Logo</label>
                                            <div class="col-sm-9">
                                                <div class="button"
                                                ngf-select="upload($file, newDeal)"
                                                ngf-accept="'image/*'"
                                                ngf-max-size="20MB"
                                                ngf-pattern="'image/*'"
                                                >
                                                    <button class="btn btn-primary btn-sm">Select image...</button>
                                                </div>
                                                <p><small>* Should be 250x200 dimensions</small></p>
                                                <div class="preview-deal-container">
                                                    <img ng-show="previewImg" ng-src="@{{previewImg}}" alt="" class="preview-deal-img">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Slug</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="deal-name" ng-model="newDeal.slug" ng-focus="isSlugFocus = true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Meta title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="" ng-model="newDeal.meta_title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Meta Description</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="" ng-model="newDeal.meta_description">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Meta keywords</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="" ng-model="newDeal.meta_keywords">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" ng-click="createDeal()" id="createDealButton" class="btn btn-success" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="editDealForm" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit deal</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Edit</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Config</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Type</label>
                                            <div class="col-sm-9">
                                                <select ng-model="editDeal.type"
                                                class="form-control"
                                                ng-options="type.name as type.display_name for type in types">
                                                    <option value="" disabled>Please select type of the deal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Deal title" ng-model="editDeal.title" ng-change="onChangeDealName()">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Cashback rate</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" ng-model="editDeal.cash_back_rate">
                                                    <span class="input-group-addon">%</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Store</label>
                                                <div class="col-sm-9">
                                                    <select ng-model="editDeal.store_id"
                                                    class="form-control"
                                                    ng-options="store.id as store.name for store in allStores">
                                                    <option value="" disabled>Please select store</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Published at</label>
                                            <div class="col-sm-9">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker" ng-model="editDeal.published_at">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Expired at</label>
                                            <div class="col-sm-9">
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right datepicker" ng-model="editDeal.expired_at">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Description</label>
                                            <div class="col-sm-9">
                                                <textarea type="text" class="form-control" placeholder="" ng-model="editDeal.description" rows="4" ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Coupon code</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="A1B2C3" ng-model="editDeal.coupon_code">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Order</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="The bigger number, the higher deal stand." ng-model="editDeal.sorder">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Origin Url</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="http://" ng-model="editDeal.origin_url">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Affiliate Url</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="http://" ng-model="editDeal.affiliate_url">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Status</label>
                                            <div class="col-sm-3">
                                                <select ng-model="editDeal.status"
                                                class="form-control"
                                                ng-options="status.value as status.name for status in statuses">
                                                    <option value="" disabled>Please select status</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="checkbox" id="id-hot-deal-edit" ng-model="editDeal.is_hot_deal" ng-checked="editDeal.is_hot_deal == 1" ng-true-value="1" ng-false-value="0">
                                                <label for="id-hot-deal-edit" class="control-label">Is hot deal</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Logo</label>
                                            <div class="col-sm-9">
                                                <div class="button"
                                                ngf-select="upload($file, editDeal)"
                                                ngf-accept="'image/*'"
                                                ngf-max-size="20MB"
                                                ngf-pattern="'image/*'"
                                                >
                                                    <button class="btn btn-primary btn-sm">Select image...</button>
                                                </div>
                                                <p><small>* Should be 250x200 dimensions</small></p>
                                                <div class="preview-deal-container">
                                                    <img ng-show="previewImg" ng-src="@{{previewImg}}" alt="" class="preview-deal-img">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Slug</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="deal-name" ng-model="editDeal.slug" ng-focus="isSlugFocus = true">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Meta title</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="" ng-model="editDeal.meta_title">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Meta Description</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="" ng-model="editDeal.meta_description">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Meta keywords</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="" ng-model="editDeal.meta_keywords">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" ng-click="updateDeal()" id="updateDealButton" class="btn btn-success" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="deleteDealForm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete deal</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete @{{deleteDeal.name}} deal?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button ng-click="destroyDeal()" id="deleteDealButton" class="btn btn-danger" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Delete</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="/sys/css/bootstrap-datepicker.css">
<script src="/sys/js/script/bootstrap-datepicker.js" charset="utf-8"></script>

<script type="text/javascript">
//Date picker
$('.datepicker').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd',
})
</script>
