<div class="box box-solid" ng-cloak>
    <div class="box-body">
        <button href="javascript:void(0)"
                class="btn btn-warning btn-sm"
                data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."
                id="checkoutAllUser"
                title="Checkout all user"
                ng-click="checkoutAllUser(users)">
            <i class="fa fa-caret-square-o-right"> Checkout All</i>
        </button>
        <table class="table table-bordered" style="margin-top: 10px">
            <tbody>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Cashback</th>
                    <th style="width:160px;"></th>
                </tr>
                <tr ng-repeat="user in users">
                    <td>@{{ $index + 1 }}</td>
                    <td>
                        <span>@{{ user.name }}</span>
                    </td>
                    <td>
                        <span>@{{ user.email }}</span>
                    </td>
                    <td>
                        <span>@{{ user.total_cashback }}</span>
                    </td>
                    <td>
                        <button href="javascript:void(0)" class="btn btn-primary btn-sm" title="View this user" ng-click="showPaymentCheckout(user.list_order_id)">
                            <i class="fa fa-eye"></i>
                        </button>
                        <button href="javascript:void(0)"
                                class="btn btn-danger btn-sm"
                                title="Checkout this user"
                                data-loading-text="<span class='fa fa-spinner fa-spin'></span> Loading..."
                                id="checkout-user-@{{ user.id }}"
                                ng-click="checkoutUser(user.id, user.list_order_id, user.total_cashback)">
                            <i class="fa fa-caret-square-o-right"> Checkout</i>
                        </button>
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
