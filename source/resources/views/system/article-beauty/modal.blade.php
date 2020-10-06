<div class="modal fade" id="createArticleForm" tabindex="-1" role="dialog" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog" role="document" style="width: 95%; max-height: 100vh;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tạo mới bài viết</h4>
                <ul class="nav nav-tabs">
                    <li class="active create-tab create-tab-active"><a href="#tab_general" data-toggle="tab">Tổng quan</a></li>
                    <li class="create-tab"><a href="#tab_intro" data-toggle="tab">Giới thiệu</a></li>
                    <li class="create-tab"><a href="#tab_faculty" data-toggle="tab">Công dụng</a></li>
                    <li class="create-tab"><a href="#tab_procedure" data-toggle="tab">Quy trình điều trị</a></li>
                    <li class="create-tab"><a href="#tab_forte" data-toggle="tab">Ưu điểm</a></li>
                </ul>
            </div>
            <div class="modal-body tab-content" style="overflow-y: auto; max-height: calc(100vh - 205px);">
                <div class="tab-pane active create-tab create-tab-active" id="tab_general">
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
                    <div class="form-group col-sm-6">
                        <label for="" class="col-sm-2 control-label">Meta title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="newArticle.meta_title">
                        </div>
                    </div>
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
                        <label for="" class="col-sm-2 control-label">Tổng quan</label>
                        <div class="col-sm-12">
                            <textarea id="articleContent" ng-model="newArticle.description" style="width:100%"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane create-tab" id="tab_intro">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Giới thiệu</label>
                        <div class="col-sm-12">
                            <textarea id="articleIntro" ng-model="newArticle.intro" style="width:100%"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane create-tab" id="tab_faculty">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Công dụng</label>
                        <div class="col-sm-12">
                            <textarea id="articleFaculty" ng-model="newArticle.faculty" style="width:100%"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane create-tab" id="tab_procedure">
                    <h3>Quy trình điều trị <i class="glyphicon glyphicon-plus" id="btn-create-new-procedure" style="color: #008d4c; cursor: pointer" ng-click="addProcedureCreate()"></i></h3>
                    <div class="form-group col-sm-12" ng-repeat="procedure in listProcedure">
                        <label for="" class="col-sm-2 control-label">Quy trình điều trị @{{ $index + 1 }} <i class="glyphicon glyphicon-minus" style="color: #dd4b39; cursor: pointer" ng-click="removeProcedureCreate(procedure)"></i></label>
                        <div class="col-sm-12">
                            <textarea class="articleProcedure"  style="width:100%"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane create-tab" id="tab_forte">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Ưu điểm</label>
                        <div class="col-sm-12">
                            <textarea id="articleForte" ng-model="newArticle.forte" style="width:100%"></textarea>
                        </div>
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
                <ul class="nav nav-tabs">
                    <li class="active edit-tab edit-tab-active"><a href="#tab_general_edit" data-toggle="tab">Tổng quan</a></li>
                    <li class="edit-tab"><a href="#tab_intro_edit" data-toggle="tab">Giới thiệu</a></li>
                    <li class="edit-tab"><a href="#tab_faculty_edit" data-toggle="tab">Công dụng</a></li>
                    <li class="edit-tab"><a href="#tab_procedure_edit" data-toggle="tab">Quy trình điều trị</a></li>
                    <li class="edit-tab"><a href="#tab_forte_edit" data-toggle="tab">Ưu điểm</a></li>
                </ul>
            </div>
            <div class="modal-body tab-content" style="overflow-y: auto; max-height: calc(100vh - 205px);">
                <div class="tab-pane active edit-tab edit-tab-active" id="tab_general_edit">
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
                    <div class="form-group col-sm-6">
                        <label for="" class="col-sm-2 control-label">Meta title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" ng-model="editArticle.meta_title">
                        </div>
                    </div>
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
                        <label for="" class="col-sm-2 control-label">Tổng quan</label>
                        <div class="col-sm-12">
                            <textarea id="editArticleContent" ng-model="editArticle.description" style="width:100%"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane edit-tab" id="tab_intro_edit">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Giới thiệu</label>
                        <div class="col-sm-12">
                            <textarea id="editArticleIntro" ng-model="editArticle.intro" style="width:100%"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane edit-tab" id="tab_faculty_edit">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Công dụng</label>
                        <div class="col-sm-12">
                            <textarea id="editArticleFaculty" ng-model="editArticle.faculty" style="width:100%"></textarea>
                        </div>
                    </div>
                </div>
                <div class="tab-pane edit-tab" id="tab_procedure_edit">
                    <h3>Quy trình điều trị <i class="glyphicon glyphicon-plus" id="btn-create-new-procedure" style="color: #008d4c; cursor: pointer" ng-click="addProcedureEdit()"></i></h3>
                    <div class="form-group col-sm-12" ng-repeat="procedure in listProcedureEdit">
                        <label for="" class="col-sm-2 control-label">Quy trình điều trị @{{ $index + 1 }} <i class="glyphicon glyphicon-minus" style="color: #dd4b39; cursor: pointer" ng-click="removeProcedureEdit(procedure)"></i></label>
                        <div class="col-sm-12">
                            <textarea class="editArticleProcedure" style="width:100%">@{{ procedure.value }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="tab-pane edit-tab" id="tab_forte_edit">
                    <div class="form-group col-sm-12">
                        <label for="" class="col-sm-2 control-label">Ưu điểm</label>
                        <div class="col-sm-12">
                            <textarea id="editArticleForte" ng-model="editArticle.forte" style="width:100%"></textarea>
                        </div>
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
