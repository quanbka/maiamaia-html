<div class="box box-solid" ng-cloak>
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Payment at</th>
                    <th style="width:50px;"></th>
                </tr>
                <tr ng-repeat="payment in payments">
                    <td>@{{ $index + 1 }}</td>
                    <td>
                        <span>@{{ payment.name }}</span>
                    </td>
                    <td>
                        <span>@{{ payment.email }}</span>
                    </td>
                    <td>
                        <span>@{{ payment.amount }}</span>
                    </td>
                    <td>
                        <span>@{{ summarizeDateTime(payment.checkout_at, true) }}</span>
                    </td>

                    <td>
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm" title="View this payment" ng-click="showPayment(payment.id)">
                            <i class="fa fa-eye"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="pull-right" style="margin-right: 30px; margin-top: 10px;">
            <?=
            view('/system/common/pagination', [
                "accessPageId" => "pageId",
                "accessPagesCount" => "pagesCount",
                "accessFind" => "find(null)"
            ]);
            ?>
        </div>

    </div>
</div>

<div class="modal fade" id="createPage" tabindex="-1" role="dialog" data-keyboard="true" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">List orders</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <th>Id</th>
                        <th>Store</th>
                        <th>Deal</th>
                        <th>Amount</th>
                        <th>Cashback</th>
                        <th>Create at</th>
                    </tr>
                    <tr ng-repeat="order in orders">
                        <td>@{{$index + 1}}</td>
                        <td>
                            <span>@{{ order.store_name }}</span>
                        </td>
                        <td>
                            <span>@{{ order.deal_title }}</span>
                        </td>
                        <td style="text-align: right">
                            <span>@{{ order.amount }}</span>
                        </td>
                        <td style="text-align: right">
                            <span>@{{ order.cash_back_amount }}</span>
                        </td>
                        <td>
                            <span>@{{ summarizeDateTime(order.created_at) }}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
