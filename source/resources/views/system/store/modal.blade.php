<style media="screen">
        .preview-store-container{
/*            padding: 10px;
            width: 100%;
            height: 122px;
            text-align: left;*/
        }
        .preview-store-img{
            max-width: 100%;
            max-height: 102px;

        }
    @media (min-width:1240px){
        .modal-lg{
            width: 1200px ;
        }
    }
    .tab-content>.tab-pane{
        padding-top: 5px;
    }
</style>

<div class="modal fade" id="modalStore" role="dialog" data-keyboard="true" data-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">@{{modalTitle}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#basic" data-toggle="tab">Basic</a></li>
                                <li><a href="#config" data-toggle="tab">Config</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="basic">
                                    <form class="form-horizontal" role="form">
                                        <input type="hidden" ng-model="store.id"/>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" ng-model="store.name" placeholder="Title" ng-change="onTitleChange()"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Slug</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" ng-model="store.slug"placeholder="Slug" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Cashback rate</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" ng-model="store.cash_back_rate"placeholder="Cash Back Rate" />
                                                        <span class="input-group-addon">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Category</label>
                                                <div class="col-sm-9">
                                                    <select ng-model="store.category_id"
                                                            class="form-control"
                                                            ng-options="category.id as category.name for category in allCategories">
                                                        <option value="" disabled>Please select category</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Description</label>
                                                <div class="col-sm-9">
                                                    <textarea ng-model="store.description" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Origin Url</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" ng-model="store.origin_url"placeholder="Origin Url" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Affiliate Url</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" ng-model="store.affiliate_url"placeholder="Affiliate Url" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Logo</label>
                                                <div class="col-sm-9">
                                                    <div class="button"
                                                         ngf-select="upload($file, store)"
                                                         ngf-accept="'image/*'"
                                                         ngf-max-size="20MB"
                                                         ngf-pattern="'image/*'"
                                                         >
                                                        <button class="btn btn-primary btn-sm">Select image...</button>
                                                    </div>
                                                    <div class="preview-store-container">
                                                        <img ng-show="previewImg!=''" ng-src="@{{previewImg}}" alt="Preview" class="preview-store-img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Status</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" ng-model="store.status" ng-options="item.name for item in statuses"></select>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="clearfix"></div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="config">
                                    <form class="form-horizontal" role="form">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">MTitle</label>
                                                <div class="col-sm-9">
                                                    <textarea ng-model="store.meta_title" class="form-control" placeholder="Meta Title"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">MDescription</label>
                                                <div class="col-sm-9">
                                                    <textarea ng-model="store.meta_description" class="form-control" placeholder="Meta Description"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">MKeywords</label>
                                                <div class="col-sm-9">
                                                    <textarea ng-model="store.meta_keywords" class="form-control" placeholder="Meta Keywords"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">FShipping</label>
                                                <div class="col-sm-9">
                                                    <textarea ng-model="store.freeshipping" class="form-control" placeholder="About Free Shipping"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">SSecrets</label>
                                                <div class="col-sm-9">
                                                    <textarea ng-model="store.secret" class="form-control" placeholder="About Shopping Secrets"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Terms</label>
                                                <div class="col-sm-9">
                                                    <textarea ng-model="store.terms" class="form-control" placeholder="Terms"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="" class="col-sm-3 control-label">Banner</label>
                                                <div class="col-sm-9">
                                                    <div class="button"
                                                         ngf-select="upload($file, store,'banner')"
                                                         ngf-accept="'image/*'"
                                                         ngf-max-size="20MB"
                                                         ngf-pattern="'image/*'"
                                                         >
                                                        <button class="btn btn-primary btn-sm">Select image...</button>
                                                    </div>
                                                    <div class="preview-store-container">
                                                        <img ng-src="@{{previewBanner}}" alt="" class="preview-store-img">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="saveButton" type="button" ng-show="mode != 'detail'" class="btn btn-primary save" ng-click="save(mode)" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Save</button>
            </div>
        </div>
    </div>
</div>

<div id="deleteStoreForm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete store</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete @{{deleteStore.name}} store?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button ng-click="destroyStore()" id="deleteStoreButton" class="btn btn-danger" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Delete</button>
            </div>
        </div>
    </div>
</div>
