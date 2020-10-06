<div class="modal fade" id="bannerForm" tabindex="-1" role="dialog" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog" role="document" style="width: 80%; max-height: 570px; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 ng-show="mode == 'create'" class="modal-title">Tạo mới Banner</h4>
                <h4 ng-show="mode == 'update'" class="modal-title">Cập nhật Banner</h4>
            </div>
            <div class="modal-body">
                <div class="form-group col-sm-12">
                    <label for="" class="col-sm-2 control-label">Tiêu đề<span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Tiêu đề" ng-model="banner.title">
                    </div>
                </div>
                <div class="form-group col-sm-12">
                    <label for="" class="col-sm-2 control-label">Key<span style="color: red">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="Key" ng-model="banner.key">
                    </div>
                </div>
                <div class="clearfix"></div>
                <table class="table table-bordered" style="border-collapse:unset">
                <tbody class="sortable" border="1">
                    <tr>
                        <td>Vị trí</td>
                        <td>URL</td>
                        <td>Hình ảnh</td>
                        <td></td>
                    </tr>
                    <tr ng-repeat="image in banner.images" class="ui-state-default">
                        <td>
                            <a title="Lên" href="javascript:;" ng-click="megaSortable('up', $index)"><img width="12" src="/sys/images/up_icon.png" ng-show="$index > 0"></a>
                            <a title="Xuống" href="javascript:;" ng-click="megaSortable('down', $index)"><img width="12" src="/sys/images/down_icon.png" ng-show="$index < (banner.images.length - 1)"></a>
                        </td>
                        <td class='w-150'><input type="text" ng-model="image.url" placeholder="URL ảnh @{{$index + 1}}"></td>
                        <td class='w-150'>
                            <img style="max-width: 35px; max-height: 35px" ng-show="image.image_url != null && image.image_url != ''" class="variant_image" ng-src="@{{image.image_url != '' ? image.image_url : ''}}"/>
                        </td>
                        <td>
                            <a class="command-link" href="javascript:;" ng-click="removeImage($index, image.image_url)">Xóa</a>
                        </td>
                    </tr>
                </tbody>
                <tfoot style="border:none">
                    <tr>
                        <td valign="top" style="border:none">
                            <button ngf-select ngf-multiple="true"
                                    ngf-accept="'.jpg,.png'" ng-model="images">Thêm slide</button>
                        </td>
                    </tr>
                </tfoot>
            </table>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default pull-left" data-dismiss="modal">Đóng</button>
                <button ng-click="save()" id="saveButton" class="btn btn-success" data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Lưu</button>
            </div>
        </div>
    </div>
</div>
    