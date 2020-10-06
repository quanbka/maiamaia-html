<div class="box box-solid">
    <div class="box-body">

        <table class="table table-bordered" style="font-size: 12px;">
            <tbody>
                <tr>
                    <th></th>
                    <th class="col-md-2">Name</th>
                    {{-- <th>Slug</th> --}}
                    <th class="col-md-2" style="word-wrap: break-word;">Content</th>
                    <th class="col-md-1">Store</th>
                    <th class="col-md-1">Type</th>
                    <th class="col-md-2">Url</th>
                    <th class="col-md-1">PLSH & EXP</th>
                    <th class="col-md-1" style="width: 11%;">
                        ORD
                        <button id="submit-order"
                                class="btn btn-info"
                                ng-click="saveSortOrders(deals)" style="height: 30px"
                                data-loading-text="<span class='fa fa-spinner fa-spin'></span>Save">Save</button>
                    </th>
                    <th>Created by<br/>
                    Update by</th>
                    <th>Status</th>
                    <th class="col-md-1 text-center"></th>
                </tr>
                <tr ng-repeat="item in deals">
                    <td><img ng-if="item.is_hot_deal == 1" src="/sys/images/star.png" width="30px" data-toggle="tooltip" data-placement="top" title="Is hot deal"></td>
                    <td  class="col-md-2">
                        @{{ item.title }}
                        <p>@{{ item.id + ' • ' + summarizeDate(item.created_at) + ' • ' +  summarizeDate(item.updated_at) }}</p>
                    </td>
                    {{-- <td ng-bind="item.slug"></td> --}}
                    <td ng-bind="item.description"  class="col-md-2" style="word-break: break-all;"></td>
                    <td>
                        <a ng-href="{{ config('app.frontend_url' )}}@{{rebuildStores[item.store_id].slug}}" target="_blank">
                            <span ng-bind="rebuildStores[item.store_id].name"></span>
                        </a>
                    </td>
                    <td ng-bind="item.type"></td>
                    <td class="col-md-2" style="word-break: break-all;">
                        <p>Url : @{{ item.origin_url }}</p>
                        <p>Affiliate Url : @{{ item.affiliate_url }}</p>
                    </td>
                    <td>
                        <p>P: @{{summarizeDate(item.published_at, true)}}</p>
                        <p>E: @{{summarizeDate(item.expired_at, true)}}</p>
                        <p></p>
                    </td>
                    <td>
                        <div class="input-group input-group-sm">
                            <input type="text" class="form-control" ng-model="item.sorder" style="width: 60px; margin-left: 40%;" >
                          </div>
                        </p>
                    </td>
                    <td>@{{item.created_by}}<br/>@{{item.updated_by}}
                    </td>
                    <td ng-bind="item.status"></td>
                    <td><a href="javascript:void(0)" class="btn btn-primary btn-sm" title="Edit this deal" ng-click="showEditDealForm(item)">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Remove this deal" ng-click="showDeleteDealForm(item)">
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
