<div class="box box-solid">
    <div class="box-body">

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th style="width: 80px;">Cover Image</th>
                    <th style="width: 80px;">Title</th>
                    <th style="width:200px;">Url</th>
                    <th style="width: 80px;">Category</th>
                    <th style="width: 80px;">Created by</th>
                    <th style="width: 80px;">Created at</th>
                    <th style="width: 80px;">Update by</th>
                    <th style="width: 80px;">Update at</th>
                    <th style="width: 80px;">Status</th>
                    <th style="width:85px;"></th>
                </tr>
                <tr ng-repeat="item in stores">
                    <td><img ng-src="@{{getCdnUrl(item.logo_url)}}" style="max-width: 200px; max-height: 40px;"></td>
                    <td>
                        <a ng-href="{{ config('app.frontend_url' )}}@{{item.slug}}" target="_blank">
                            <span ng-bind="item.name"></span>
                        </a>
                    </td>
                    <td style="width:200px;word-break: break-all;">
                        <p>Url : @{{ item.origin_url }}</p>
                        <p>Affiliate Url : @{{ item.affiliate_url }}</p>
                    </td>
                    <td ng-bind="rebuildCategories[item.category_id].name"></td>
                    <td ng-bind="item.created_by"></td>
                    <td ng-bind="summarizeDate(item.created_at, true)"></td>
                    <td ng-bind="item.updated_by"></td>
                    <td ng-bind="summarizeDate(item.updated_at, true)"></td>
                    <td ng-bind="item.status"></td>
                    <td><a href="javascript:void(0)" class="btn btn-primary btn-sm" title="Edit this store" ng-click="openCreateOrUpdateDialog('update',item)">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Remove this store" ng-click="showDeleteStoreForm(item)">
                           <i class="fa fa-times"></i>
                       </a>

                    </td>
                </tr>
              </tbody>
          </table>
          <div class="center">
            @include('system.common.pagination', [
              'accessPageId' => 'filter.page',
              'accessPagesCount' => 'pagesCount',
              'accessFind' => 'getDeals()'
              ])
          </div>
    </div>
</div>
