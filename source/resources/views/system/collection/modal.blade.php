<div id="collectionForm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" ng-click="resetForm();">&times;</button>
                <h4 class="modal-title" ng-show="mode!='update'">Create new collection</h4>
                <h4 class="modal-title" ng-show="mode=='update'">Update collection #@{{ collection.name }}</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group @{{ (formErrors != null && formErrors.field == 'name') ? 'has-error' : '' }}">
                        <label for="" class="col-sm-3 control-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" placeholder="Collection Name" ng-model="collection.name" ng-change="onChangeCategoryName()">
                        </div>
                    </div>
                    <div class="form-group @{{ (formErrors != null && formErrors.field == 'slug') ? 'has-error' : '' }}">
                        <label for="" class="col-sm-3 control-label">Slug</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" placeholder="collection-name" ng-model="collection.slug" ng-focus="isSlugFocus = true">
                        </div>
                    </div>
                    <div class="form-group @{{ (formErrors != null && formErrors.field == 'description') ? 'has-error' : '' }}">
                        <label for="" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control input-sm" placeholder="" ng-model="collection.description"></textarea>
                        </div>
                    </div>
                    <div class="form-group @{{ (formErrors != null && formErrors.field == 'meta_title') ? 'has-error' : '' }}">
                        <label for="" class="col-sm-3 control-label">Meta title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" placeholder="" ng-model="collection.meta_title">
                        </div>
                    </div>
                    <div class="form-group @{{ (formErrors != null && formErrors.field == 'meta_description') ? 'has-error' : '' }}">
                        <label for="" class="col-sm-3 control-label">Meta Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" placeholder="" ng-model="collection.meta_description">
                        </div>
                    </div>
                    <div class="form-group @{{ (formErrors != null && formErrors.field == 'meta_keywords') ? 'has-error' : '' }}">
                        <label for="" class="col-sm-3 control-label">Meta keywords</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" placeholder="" ng-model="collection.meta_keywords">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="show_store" class="col-sm-6 control-label @{{ (formErrors != null && formErrors.field == 'show_store') ? 'has-error' : '' }}">
                          <input type="checkbox" id="show_store" name="show_store" ng-model="collection.show_store"> Show store.
                        </label>
                        <label for="show_deal" class="col-sm-6 control-label @{{ (formErrors != null && formErrors.field == 'show_deal') ? 'has-error' : '' }}">
                          <input type="checkbox" id="show_deal" name="show_deal"  ng-model="collection.show_deal"> Show deal.
                        </label>
                    </div>
                    <div class="form-group @{{ (formErrors != null && formErrors.field == 'status') ? 'has-error' : '' }}">
                        <label for="" class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-9">
                            <select ng-model="collection.status"
                                    class="form-control input-sm" ng-change="save();"
                                    ng-options="status.value for status in statuses track by status.code">
                            </select>
                        </div>
                    </div>
                    <div class="form-group @{{ (formErrors != null && formErrors.field == 'store') ? 'has-error' : '' }}">
                        <label for="" class="col-sm-3 control-label">Store</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control input-sm" placeholder="" ng-model="collection.store" ng-change="findStore();">
                            <input type="hidden" class="from-control" ng-model="collection.store_id" />
                            <div class="form-group find-stores" ng-show="stores.length > 0">
                                <table class="table table-bordered">
                                    <tr class="head">
                                      <td class="w-20">STT</td>
                                      <td>Name</td>
                                      <td>#</td>
                                    </tr>
                                    <tr class="@{{ ($index % 2 == 0) ? 'odd' : 'even' }}" ng-repeat="store in stores track by $index">
                                        <td class="w-10" ng-bind="$index + 1"></td>
                                        <td ng-bind="store.name"></td>
                                        <td><span class="text-warning text-link" ng-click="selectStore(store);">select</a></td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                              <ul style="list-style: none;">
                                  <li style="float:left; margin: 0 0 0 5px;" ng-repeat="st in collectionStore">
                                    <a class="btn btn-xs btn-warning" ng-click="removeStore(st)">@{{ st.s_name}} <i class="fa fa-remove"></i></a>
                                  </li>
                              </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-default pull-left" data-dismiss="modal" ng-click="resetForm();">Close</button>
                <span ng-show="formErrors != null" class="text-danger">@{{ formErrors.message }}</span>
                <button type="submit" ng-click="createCollection()" id="createCollectionButton" class="btn btn-sm btn-success" ng-show="mode!='update'" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Create</button>
                <button type="submit" ng-click="updateCollection()" id="updateCollectionButton" class="btn btn-sm btn-success" ng-show="mode=='update'" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Update</button>
            </div>
        </div>
    </div>
</div>

<div id="deleteCategoryForm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete category</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete @{{deleteCategory.name}} category?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button ng-click="destroyCategory()" id="deleteCategoryButton" class="btn btn-danger" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Delete</button>
            </div>
        </div>
    </div>
</div>
