/**
 * Created by tuanpa on 1/19/18.
 */
system.controller("OrderController", OrderController);
/**
 *
 * @param {type} $scope
 * @param {type} $http
 * @param {type} $rootScope
 * @returns {undefined}
 */
function OrderController($scope, $http, $rootScope, $timeout) {
    $scope.controllerName = "OrderController";
    $scope.filter = {
        pageId: 0
    };
    $scope.orders = [];
    $scope.pageSize = 40;
    $scope.resetFilter = function () {
        $scope.filter = {
            pageId: 0
        }
    };

    this.initialize = function () {
        api_domain = '';
        $scope.resetFilter();
        $scope.find();
    };

    $scope.find = function () {
        url = api_domain + "/api/order";
        $('#searchOrder').button('loading');
        var filter = buildFilter();
        $http.get(url, {params: filter}).success(function (response) {
            if (response.status != null && response.status == 'successful') {
                $scope.orders = response.data;
                $scope.pagesCount = response.paginator.page_count;
            }
            $('#searchOrder').button('reset');
        });

    };

    function buildFilter() {
        var filter = {
            api_token,
            page_id: $scope.filter.pageId + 1,
            page_size: $scope.pageSize
        };
        if ($scope.filter.create_from != null) {
            filter.create_from = $scope.filter.create_from;
        }
        if ($scope.filter.create_to != null) {
            filter.create_to = $scope.filter.create_to;
        }
        return filter;
    }

    $scope.reset = function () {
        $scope.resetFilter();
    };


    $scope.edit = function (order) {
        $scope.order = angular.copy(order);
        $('#editOrderForm').modal('show');
    };

    $scope.delete = function (order) {
        var comfirm = confirm("Bạn có chắc chắn muốn xóa order");
        var url = api_domain + "/api/order/" + order.id;
        $http.delete(url, {
            params: {api_token}
        }).success(function (reponse) {
            $scope.find();
        });

    }

    $scope.save = function () {
        var url = '/api/order/' + $scope.order.id;
        $http.put(url, $scope.order).success(function (reponse) {
            $('#editOrderForm').modal('hide');
        });
    };


    this.initialize();

}
