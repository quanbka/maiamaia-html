system.controller("CategoryController", CategoryController);
/**
 *
 * @param {type} $scope
 * @param {type} $http
 * @param {type} $rootScope
 * @returns {undefined}
 */
function CategoryController($scope, $http, $rootScope, $timeout, Upload) {
    $scope.controllerName = "CategoryController";
    this.__proto__ = new BaseController($scope, $http, $rootScope);
    this.initialize = function(){
        $scope.initStatuses();
        $scope.initTypes();
        $scope.initNewCategory();
        $scope.resetFilter();
        $scope.getCategories();
    }

    $scope.typeCategory = typeCategory;

    $scope.initStatuses = function(){
        $scope.statuses = [
            {
                'value' : 'enable',
                'name' : 'enable'
            },
            {
                'value' : 'disable',
                'name' : 'disable'
            },
        ];
    }

    $scope.initTypes = function(){
        $scope.types = [
            {
                'value' : 'store',
                'name' : 'Store'
            },
            {
                'value' : 'news',
                'name' : 'News'
            },
            {
                'value' : 'help',
                'name' : 'Help'
            }
        ];
    }



    $scope.initNewCategory = function(){
        $scope.newCategory = {
            'status': 'enable',
        }
    };

    $scope.resetFilter = function(){
        $scope.filter = {
            name: "",
            email: "",
            status: "",
            type: "",
            page: 0,
        }
    }

    $scope.getCategories = function(){
        url = api_domain + "/api/category";
        $('#searchCategoryButton').button('loading');
        $scope.buildParam();
        $http({
            url: url,
            method: "GET",
            params: {
                api_token,
                name: $scope.params.name,
                email: $scope.params.email,
                status: $scope.params.status,
                type: typeCategory,
                page_id : $scope.params.page + 1,
                page_size : 15,
                with_user : true,
            },
            header: {
                'Content-Type': 'application/json',
            },
        }).then(
            function(response){
                $scope.categories = response.data.data;
                $scope.categories = getIntValOrder($scope.categories);
                $scope.pagesCount = response.data.paginator.page_count;
                $('#searchCategoryButton').button('reset');
            }
        );
    }

    function getIntValOrder(categories) {
        for (var index = 0; index < categories.length; ++index) {
            categories[index].order = parseInt(categories[index].order);
        }
        return categories;
    }

    $scope.buildParam = function(){
        $scope.params = angular.copy($scope.filter);
        for(var key in $scope.params){
            if($scope.params[key] === ''){
                delete ($scope.params[key]);
            }
        }
    }

    $scope.reset = function(){
        $scope.resetFilter();
        $scope.getCategories();
    }

    $scope.showCreateCategoryForm = function(){
        $scope.isSlugFocus = false;
        $('#createCategoryForm').modal('show');
    }



    $scope.createCategory = function(){
        $('#createCategoryButton').button('loading');
        url = api_domain + "/api/category";
        $scope.newCategory.type = typeCategory;
        $http({
            url: url,
            method: "POST",
            header: {
                'Content-Type': 'application/json',
            },
            params: {
                api_token,
            },
            data: $scope.newCategory

        }).then(
            function(response){
                if (response.data.status == 'successful') {
                    showMessage('Created category', 'The category has been created!', 'success');
                    $('#createCategoryButton').button('reset');
                    $('#createCategoryForm').modal('hide');
                    $scope.initNewCategory();
                    $scope.error = {};
                    $scope.getCategories();
                } else {
                    $scope.error = response.data.message;
                }
            },
            function error(response){
                $('#createCategoryButton').button('reset');
                showMessage('Can not created!', 'Please contact technical team for support!', 'error');

            }
        );
    }

    $scope.showEditCategoryForm = function(category){
        $scope.editCategory = angular.copy(category);
        delete($scope.editCategory.updated_at);
        $('#editCategoryForm').modal('show');
    }

    $scope.updateCategory = function(){
        $('#updateCategoryButton').button('loading');
        url = api_domain + "/api/category/" + $scope.editCategory.id;
        $scope.editCategory.type = typeCategory;
        $http({
            url: url,
            method: "PUT",
            header: {
                'Content-Type': 'application/json',
            },
            params: {
                api_token,
            },
            data: $scope.editCategory

        }).then(
            function(response){
                $('#updateCategoryButton').button('reset');
                if (response.data.status == 'successful') {
                    showMessage('Success', 'The category has been updated', 'success');
                    $('#editCategoryForm').modal('hide');
                    $scope.getCategories();
                } else {
                    showMessage(response.data.status, response.data.title, response.data.status);
                }
            },
            function error(response){
                $('#updateCategoryButton').button('reset');
                showMessage('Can not send request!', 'Please contact technical team for support!', 'error');

            }
        );
    }

    $scope.saveSortOrders = function (items) {
        var idSubmit = '#submit-order';
        $(idSubmit).button('loading');
        var param = {
            items: items,
            api_token: api_token
        };
        $http.post(api_domain + "/api/category/update-multi-order", param).success(function (data) {
            if (data.status == 'successful') {
                showMessage('Successful!', 'Update successful!', 'success');
                $scope.getCategories();
            } else {
                showMessage('Error', data.message, 'error');
            }
            $(idSubmit).button('reset');
        });
    }

    $scope.showDeleteCategoryForm = function(category){
        $scope.deleteCategory = angular.copy(category);
        $('#deleteCategoryForm').modal('show');
    }

    $scope.destroyCategory = function(){
        url = api_domain + "/api/category/" + $scope.deleteCategory.id;
        $http({
            url: url,
            method: "DELETE",
            header: {
                'Content-Type': 'application/json',
            },
            params: {
                api_token,
            },
            data: $scope.deleteCategory

        }).then(
            function(response){
                showMessage(response.data.status, response.data.title, response.data.status);
                if (response.data.status == 'successful') {
                    $('#deleteCategoryForm').modal('hide');
                    $scope.getCategories();
                } else {
                    showMessage('Success', 'The category has been deleted', 'success');
                }
            },
            function error(response){
                showMessage('Can not send request!', 'Please contact technical team for support!', 'error');

            }
        );
    }

    $scope.onChangeCategoryName = function(){
        if(!$scope.isSlugFocus){
            $scope.newCategory.slug = $scope.slugify($scope.newCategory.name);
        }
    }

    $scope.slugify = function(name){
        return name.toString().toLowerCase().trim()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/&/g, '-and-')         // Replace & with 'and'
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-');        // Replace multiple - with single -
    }

    this.initialize();

}
