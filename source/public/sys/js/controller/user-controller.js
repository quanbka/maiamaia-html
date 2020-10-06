system.controller("UserController", UserController);
/**
 *
 * @param {type} $scope
 * @param {type} $http
 * @param {type} $rootScope
 * @returns {undefined}
 */
function UserController($scope, $http, $rootScope, $timeout, Upload) {
    $scope.controllerName = "UserController";

    this.initialize = function(){
        $scope.initStatuses();
        $scope.initPaymentTypes();
        $scope.initNewUser();
        $scope.resetFilter();
        $scope.getUsers();
    }

    $scope.initStatuses = function(){
        $scope.statuses = [
            {
                'value' : 'active',
                'name' : 'Hoạt động'
            },
            {
                'value' : 'pending',
                'name' : 'Chờ xác nhận'
            },
            {
                'value' : 'banned',
                'name' : 'Khóa'
            }
        ];
    }

    $scope.initPaymentTypes = function(){
        $scope.payment_types = [
            {
                'value' : 'paypal',
                'name' : 'Paypal'
            },
        ];
    }

    $scope.initNewUser = function(){
        $scope.newUser = {
            'status': 'active',
            'payment_type': 'paypal',
        }
    };

    $scope.resetFilter = function(){
        $scope.filter = {
            name: "",
            email: "",
            status: "",
            page: 0,
        }
    }

    $scope.getUsers = function(){
        url = api_domain + "/api/user/find";
        $('#searchUserButton').button('loading');
        $http({
            url: url,
            method: "GET",
            params: {
                api_token,
                name: $scope.filter.name,
                email: $scope.filter.email,
                status: $scope.filter.status,
                page : $scope.filter.page + 1, // Offset page
                page_size : 15,
            },
            header: {
                'Content-Type': 'application/json',
            },
        }).then(
            function(response){
                $scope.users = response.data.data;
                $scope.pagesCount = response.data.last_page;
                $('#searchUserButton').button('reset');
            }
        );
    }

    $scope.reset = function(){
        $scope.resetFilter();
        $scope.getUsers();
    }

    $scope.showCreateUserForm = function(){

        $('#createUserForm').modal('show');
    }

    $scope.createUser = function(){
        url = api_domain + "/api/user/create";
        $http({
            url: url,
            method: "POST",
            header: {
                'Content-Type': 'application/json',
            },
            params: {
                api_token,
            },
            data: $scope.newUser

        }).then(
            function(response){
                showMessage(response.data.status, response.data.title, response.data.status);
                if (response.data.status == 'success') {
                    $('#createUserForm').modal('hide');
                    $scope.initNewUser();
                    $scope.error = {};
                    $scope.getUsers();
                } else {
                    $scope.error = response.data.message;
                }
            },
            function error(response){
                showMessage('Can not send request!', 'Please contact technical team for support!', 'error');

            }
        );
    }

    $scope.showEditUserForm = function(user){
        // console.log(user);
        $scope.editUser = angular.copy(user);
        $('#editUserForm').modal('show');
    }

    $scope.updateUser = function(){
        url = api_domain + "/api/user/" + $scope.editUser.id;
        $http({
            url: url,
            method: "PATCH",
            header: {
                'Content-Type': 'application/json',
            },
            params: {
                api_token,
            },
            data: $scope.editUser

        }).then(
            function(response){
                showMessage(response.data.status, response.data.title, response.data.status);
                if (response.data.status == 'success') {
                    $('#editUserForm').modal('hide');
                    $scope.getUsers();
                } else {
                    showMessage(response.data.status, response.data.title, response.data.status);
                }
            },
            function error(response){
                showMessage('Can not send request!', 'Please contact technical team for support!', 'error');

            }
        );
    }

    $scope.showDeleteUserForm = function(user){
        $scope.deleteUser = angular.copy(user);
        $('#deleteUserForm').modal('show');
    }

    $scope.destroyUser = function(){
        url = api_domain + "/api/user/" + $scope.deleteUser.id;
        $http({
            url: url,
            method: "DELETE",
            header: {
                'Content-Type': 'application/json',
            },
            params: {
                api_token,
            },
            data: $scope.deleteUser

        }).then(
            function(response){
                showMessage(response.data.status, response.data.title, response.data.status);
                if (response.data.status == 'success') {
                    $('#deleteUserForm').modal('hide');
                    $scope.getUsers();
                } else {
                    showMessage(response.data.status, response.data.title, response.data.status);
                }
            },
            function error(response){
                showMessage('Can not send request!', 'Please contact technical team for support!', 'error');

            }
        );
    }

    this.initialize();

}
