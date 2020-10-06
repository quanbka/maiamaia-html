<div class="modal fade" id="createArticleForm" tabindex="-1" role="dialog" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog" role="document" style="width: 95%; max-height: 100vh;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tạo mới bài viết</h4>
            </div>
            <div class="modal-body" style="overflow-y: auto; max-height: calc(100vh - 205px);">
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Tiêu đề<span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input id="newArticleTitle" type="text" class="form-control" placeholder="Tiêu đề" ng-model="newArticle.title">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Danh mục<span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <select ng-model="newArticle.category_id" class="form-control pull-right" id="newArticleCategory"
                                ng-options="category.id as category.name for category in listCategory">
                            <option value>-- Chưa xác định --</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" id="newArticleSlug" class="form-control" placeholder="Slug" ng-model="newArticle.slug">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Trạng thái</label>
                    <div class="col-sm-10">
                        <select ng-model="newArticle.status" class="form-control pull-right"
                                ng-options="status.value as status.name for status in listStatus">
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Mô tả</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Mô tả" ng-model="newArticle.description">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Thứ tự</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" placeholder="Thứ tự" ng-model="newArticle.order">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Meta description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" ng-model="newArticle.meta_description">
                    </div>
                </div>
                {{--<div class="form-group col-sm-6">--}}
                    {{--<label for="" class="col-sm-2 control-label">Meta title</label>--}}
                    {{--<div class="col-sm-10">--}}
                        {{--<input type="text" class="form-control" ng-model="newArticle.meta_title">--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Meta keywords</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" ng-model="newArticle.meta_keywords">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Ảnh đại diện</label>
                    <div class="col-sm-10">
                        <div class="button"
                             ngf-select="upload($file, newArticle)"
                             ngf-accept="'image/*'"
                             ngf-max-size="20MB"
                             ngf-pattern="'image/*'">
                            <button class="btn btn-primary btn-sm">Chọn ảnh...</button>
                        </div>
                        <div class="preview-store-container">
                            <img ng-show="previewImg" ng-src="@{{previewImg}}" alt="Preview" class="preview-store-img img img-responsive" style="max-width: 50%">
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label for="" class="col-sm-2 control-label">Nội dung</label>
                    <div class="col-sm-12">
                        <textarea id="articleContent" ng-model="newArticle.content" style="width:100%"></textarea>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button ng-click="createArticle()" id="createArticleButton" class="btn btn-success" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Tạo mới</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editArticleForm" tabindex="-1" role="dialog" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog" role="document" style="width: 95%; max-height: 570px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cập nhật bài viết</h4>
            </div>
            <div class="modal-body" style="overflow-y: auto; max-height: calc(100vh - 205px);">
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Tiêu đề<span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input id="editArticleTitle" type="text" class="form-control" placeholder="Tiêu đề" ng-model="editArticle.title">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Danh mục<span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <select ng-model="editArticle.category_id" class="form-control pull-right" id="editArticleCategory"
                                ng-options="category.id as category.name for category in listCategory">
                            <option value>-- Chưa xác định --</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Slug</label>
                    <div class="col-sm-10">
                        <input type="text" id="editArticleSlug" class="form-control" placeholder="Slug" ng-model="editArticle.slug">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Trạng thái</label>
                    <div class="col-sm-10">
                        <select ng-model="editArticle.status" class="form-control pull-right"
                                ng-options="status.value as status.name for status in listStatus">
                        </select>
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Mô tả</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Mô tả" ng-model="editArticle.description">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Thứ tự</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" placeholder="Thứ tự" ng-model="editArticle.order">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Meta description</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" ng-model="editArticle.meta_description">
                    </div>
                </div>
                {{--<div class="form-group col-sm-6">--}}
                    {{--<label for="" class="col-sm-2 control-label">Meta title</label>--}}
                    {{--<div class="col-sm-10">--}}
                        {{--<input type="text" class="form-control" ng-model="editArticle.meta_title">--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Meta keywords</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" ng-model="editArticle.meta_keywords">
                    </div>
                </div>
                <div class="form-group col-sm-6">
                    <label for="" class="col-sm-2 control-label">Ảnh đại diện</label>
                    <div class="col-sm-10">
                        <div class="button"
                             ngf-select="upload($file, editArticle)"
                             ngf-accept="'image/*'"
                             ngf-max-size="20MB"
                             ngf-pattern="'image/*'"
                        >
                            <button class="btn btn-primary btn-sm">Chọn ảnh...</button>
                        </div>
                        <div class="preview-store-container">
                            <img ng-show="previewImg" ng-src="@{{previewImg}}" alt="Preview" class="preview-store-img img img-responsive" style="max-width: 50%">
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label for="" class="col-sm-2 control-label">Nôi dung</label>
                    <div class="col-sm-12">
                        <textarea id="editArticleContent" ng-model="editArticle.content" style="width:100%"></textarea>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button ng-click="updateArticle()" id="updateArticleButton" class="btn btn-success" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Cập nhật</button>
            </div>
        </div>
    </div>
</div>
