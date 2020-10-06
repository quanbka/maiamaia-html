<div class="box box-solid">
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Create At</th>
                    <th>Show Store</th>
                    <th>Show Deals</th>
                    <th style="width:85px;"></th>
                </tr>
                <tr ng-repeat="item in collections track by $index">
                    <td ng-bind="item.id"></td>
                    <td ng-bind="item.name"></td>
                    <td ng-bind="item.description"></td>
                    <td ng-bind="item.status"></td>
                    <td ng-bind="item.created_at"></td>
                    <td ng-bind="item.show_store"></td>
                    <td ng-bind="item.show_deal"></td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-primary btn-xs" title="Edit this order" ng-click="edit(item)">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-xs" title="Remove this order" ng-click="delete(item)">
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
