    <?php use App\Http\Controllers\Service\BaseService; 
        $policy = BaseService::getConfig('policy');
    ?>
    <div class="modal" tabindex="-1" role="dialog" id="policy" data-backdrop="static" data-keyboard="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Điều khoản sử dụng</h4>
                </div>
                <div class="modal-body" style="height:400px;overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                            <?= $policy->value; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-flat pull-right" name="agree-policy"><i class="ion-checkmark-round"></i> Đồng ý</button>
                </div>
            </div>
        </div>
    </div>