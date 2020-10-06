<div id="editOrderForm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create new order</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Cashback Amount</label>
                        <div class="col-sm-8">
                            <input type="text"
                                   class="form-control"
                                   placeholder="Name"
                                   ng-model="order.amount">
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" ng-click="save()" id="createOrEdit" class="btn btn-success"
                        data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading...">Save
                </button>
            </div>
        </div>
    </div>
</div>