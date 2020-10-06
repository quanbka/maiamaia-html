<?php
    $forms = [
        'createFrom' => [
            'id' => 'createCategoryForm',
            'title' => "Tạo mới category",
            'model' => 'newCategory',
            'method' => 'createCategory',
            'buttonID' => 'createCategoryButton',

        ],
        'editFrom' => [
            'id' => 'editCategoryForm',
            'title' => "Cập nhật category",
            'model' => 'editCategory',
            'method' => 'updateCategory',
            'buttonID' => 'updateCategoryButton',

        ],
    ];
?>

@foreach ($forms as $form)
    <div id="{{ $form['id'] }}" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ $form['title'] }}</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Tên</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="Tên" ng-model="{{ $form['model'] }}.name" ng-change="onChangeCategoryName()">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Slug</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="slug" ng-model="{{ $form['model'] }}.slug" ng-focus="isSlugFocus = true">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Mô tả</label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" placeholder="" ng-model="{{ $form['model'] }}.description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Meta title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="" ng-model="{{ $form['model'] }}.meta_title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Meta Description</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="" ng-model="{{ $form['model'] }}.meta_description">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Meta keywords</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="" ng-model="{{ $form['model'] }}.meta_keywords">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Trạng thái</label>
                            <div class="col-sm-9">
                                <select ng-model="{{ $form['model'] }}.status"
                                        class="form-control"
                                        ng-options="status.value as status.name for status in statuses">
                                    <option value="" disabled>-- Chọn trạng thái --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" ng-if="typeCategory == 'help'">
                            <label for="" class="col-sm-3 control-label">Vị trí</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" placeholder="" ng-model="{{ $form['model'] }}.order">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                    <button type="submit" ng-click="{{ $form['method'] }}()" id="{{ $form['buttonID'] }}" class="btn btn-success" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">
                        {{ $form['title'] }}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endforeach



<div id="deleteCategoryForm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Xóa danh mục</h4>
            </div>
            <div class="modal-body">
                <p>Bạn có chắc chắn xóa category: @{{deleteCategory.name}}?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button ng-click="destroyCategory()" id="deleteCategoryButton" class="btn btn-danger" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Xóa</button>
            </div>
        </div>
    </div>
</div>
