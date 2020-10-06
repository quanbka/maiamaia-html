<div class="box box-solid" ng-cloak>
    <div class="box-body">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>#</th>
                    <th>Tiêu đề</th>
                    <th>Danh mục</th>
                    <th width="11%">
                        Order
                        <button id="submit-order"
                             class="btn btn-info"
                             ng-click="saveSortOrders(articles)" style="height: 30px"
                             data-loading-text="<span class='fa fa-spinner fa-spin'></span>Save">Lưu</button>
                    </th>
                    <th>Người tạo</th>
                    <th>Người sửa mới nhất</th>
                    <th>Trạng thái</th>
                    <th style="width: 90px;"></th>
                </tr>
                <tr ng-repeat="article in articles">
                    <td>@{{ $index + 1 }}</td>
                    <td>
                        <span><a href="<?= config('app.frontend_url') ?>/dich-vu/@{{article.slug}}" target="_blank">@{{ article.title }}</a></span>
                    </td>
                    <td>
                        <span>@{{ article.category_name }}</span>
                    </td>
                    <td>
                        <input type="number" ng-model="article.order" style="width: 40px; height: 30px; margin-left: 30%">
                    </td>
                    <td>
                        <span>@{{ article.creator_name }}</span>
                    </td>
                    <td>
                        <span>@{{ article.modifier_name }}</span>
                    </td>
                    <td>
                        <span ng-if="article.status == 'enable'" class="label label-success">Hoạt động</span>
                        <span ng-if="article.status == 'disable'" class="label label-default">Dừng hoạt động</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" title="Edit this article" ng-click="showEditArticle(article)">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm" title="Delete this article" ng-click="deleteArticle(article)">
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

