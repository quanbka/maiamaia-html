<div class="box box-solid">
    <div class="box-body">

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Slug</th>
                    <th ng-if="typeCategory != 'help'">Mô tả</th>
                    <th ng-if="typeCategory == 'help'" width="11%">
                        Thứ tự
                        <button id="submit-order"
                                class="btn btn-info"
                                ng-click="saveSortOrders(categories)" style="height: 30px"
                                data-loading-text="<span class='fa fa-spinner fa-spin'></span>Save">Lưu</button>
                    </th>
                    <th>Người tạo</th>
                    <th>Thời gian tạo</th>
                    <th>Người cập nhật</th>
                    <th>Thời gian cập nhật</th>
                    <th>Trạng thái</th>
                    <th style="width:85px;"></th>
                </tr>
                <tr ng-repeat="item in categories">
                    <td ng-bind="item.id"></td>
                    <td ng-bind="item.name"></td>
                    <td ng-bind="item.slug"></td>
                    <td ng-bind="item.description" ng-if="typeCategory != 'help'"></td>
                    <td ng-if="typeCategory == 'help'">
                        <input type="number" ng-model="item.order" style="width: 40px; height: 30px; margin-left: 30%">
                    </td>
                    <td ng-bind="item.created_by"></td>
                    <td ng-bind="summarizeDate(item.created_at, true)"></td>
                    <td ng-bind="item.updated_by"></td>
                    <td ng-bind="summarizeDate(item.updated_at, true)"></td>
                    <td ng-bind="item.status"></td>
                    <td><a href="javascript:void(0)" class="btn btn-primary btn-sm" title="Edit this category" ng-click="showEditCategoryForm(item)">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Remove this category" ng-click="showDeleteCategoryForm(item)">
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
                'accessFind' => 'getCategories()'
                ])
          </div>
    </div>
</div>
