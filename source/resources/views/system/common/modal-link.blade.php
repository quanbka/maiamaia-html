
<div class="modal fade" id="getLink" tabindex="-1" data-backdrop="static" data-keybroad="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lấy link sản phẩm</h4>
            </div>
            <div class="modal-body">    
                <div class="form-group">
                    <label>Link sản phẩm</label>
                    <textarea class="form-control" ng-bind="productLinkCustom" rows="3" disabled=""></textarea>
                </div>
                <div class="form-group">
                    <label>Tracking (tùy chọn)</label>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <!-- <th class="col-xs-1 col-sm-1 col-md-1 col-lg-l text-center vertical-align">STT</th> -->
                                <th class="col-xs-7 col-sm-7 col-md-7 col-lg-7 text-center vertical-align">Tên tham số</th>
                                <th class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-center vertical-align">Giá trị</th>
                                <!-- <th class="col-xs-1 col-sm-1 col-md-1 col-lg-1 text-center vertical-align">
                                    <button type="button" class="btn btn-warning btn-sm" title="Thêm mới"><i class="fa fa-plus"></i></button>
                                </th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               <!--  <td class="text-center vertical-align">1</td> -->
                                <td class="vertical-align">
                                    <input type="text" class="form-control" ng-model="customParam" ng-init="" disabled="" />
                                </td>
                                <td class="vertical-align">
                                    <input type="text" class="form-control" ng-model="customValue" ng-keyup="changeCustomValue()" />
                                </td>
                                <!-- <td class="text-center vertical-align">
                                    <button type="button" class="btn btn-danger btn-sm" title="Xóa"><i class="fa fa-minus"></i></button>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" clipboard supported="supported" text="productLinkCustom" on-copied="success()" on-error="fail(err)"><i class="fa fa-copy"></i> Sao chép</button>
            </div>
        </div>
    </div>
</div>


