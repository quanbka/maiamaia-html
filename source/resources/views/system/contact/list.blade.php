<div class="box box-solid">
    <div class="box-body">

        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Detail</th>
                    <th>Created at</th>
                    <th>Update at</th>
                </tr>
                <tr ng-repeat="item in contacts">
                    <td ng-bind="$index + 1"></td>
                    <td ng-bind="item.name"></td>
                    <td ng-bind="item.email"></td>
                    <td ng-bind="item.detail"></td>
                    <td ng-bind="summarizeDate(item.created_at, true)"></td>
                    <td ng-bind="summarizeDate(item.updated_at, true)"></td>
                </tr>
              </tbody>
          </table>
          <div class="center">
              @include('system.common.pagination', [
                'accessPageId' => 'filter.page',
                'accessPagesCount' => 'pagesCount',
                'accessFind' => 'find()'
                ])
          </div>
    </div>
</div>
