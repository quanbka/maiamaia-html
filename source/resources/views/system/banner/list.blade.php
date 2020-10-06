<div class="box box-solid" ng-cloak>
    <div class="box-body">
        <div class="pull-right box-tools" style="margin-bottom: 10px">
            <button type="button" class="btn btn-success btn-sm" ng-click="openDialog(item,'create')">
                <i class="fa fa-plus"></i>
                Tạo mới banner
            </button>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>#</th>
                    <th>Tiều đề</th>
                    <th>Hình ảnh</th>
                    <th>Thời gian tạo</th>
                    <th style="width: 90px;"></th>
                </tr>
                <tr ng-repeat="item in items">
                    <td>@{{ $index + 1 }}</td>
                    <td>
                        <span>@{{ item.title }}</span>
                    </td>
                    <td>
                        <table>
                <tbody>
                    <tr>
                        <td ng-repeat="image in item.value">
                            <img style="border: solid 1px; margin-right: 4px;" width="50px" ng-src="@{{image.image_url}}" />
                        </td>
                    </tr>
                </tbody>
            </table>
                    </td>
                    <td>
                        <span>@{{toVietnameseDate(item.created_at, true)}}</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" title="Edit this item" ng-click="openDialog(item,'update')">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Delete this item" ng-click="delete(item)">
                            <i class="fa fa-times"></i>
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
