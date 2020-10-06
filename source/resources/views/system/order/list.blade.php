<div class="box box-solid">
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Id</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Cashback Amount</th>
                    <th>Cashback Rate</th>
                    <th>Is Cashback</th>
                    <th>DealId</th>
                    <th>StoreId</th>
                    <th style="width:85px;"></th>
                </tr>
                <tr ng-repeat="item in orders track by $index">
                    <td ng-bind="item.id"></td>
                    <td ng-bind="item.user_id"></td>
                    <td ng-bind="item.amount"></td>
                    <td ng-bind="item.cash_back_amount"></td>
                    <td ng-bind="item.cash_back_rate"></td>
                    <td ng-bind="item.is_cash_back"></td>
                    <td ng-bind="item.deal_id"></td>
                    <td ng-bind="item.store_id"></td>
                    <td><a href="javascript:void(0)" class="btn btn-primary btn-sm" title="Edit this order" ng-click="edit(item)">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Remove this order" ng-click="delete(item)">
                           <i class="fa fa-times"></i>
                       </a>

                    </td>
                </tr>
              </tbody>
          </table>
          <div class="center">
              @include('system.common.pagination', [
                'accessPageId' => 'filter.pageId',
                'accessPagesCount' => 'pagesCount',
                'accessFind' => 'find()'
                ])
          </div>
    </div>
</div>
