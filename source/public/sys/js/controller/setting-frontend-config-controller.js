system.controller("SettingFrontendConfigController", SettingFrontendConfigController);
/**
 *
 * @param {type} $scope
 * @param {type} $http
 * @param {type} $rootScope
 * @returns {undefined}
 */
function SettingFrontendConfigController($scope, $http, $rootScope, $timeout, Upload) {
    $scope.tinymceModel = 'Initial content';

    $scope.tinymceOptions = {
       plugins: 'link code',
       // toolbar: 'undo redo | styleselect | bold italic | link  | code | list',
       content_css : '/sys/css/tinymce.css'
     };

     console.log($scope.tinymceOptions);

    $scope.controllerName = "SettingFrontendConfigController";

    $scope.init = function(){
        $scope.getAllConfigs();
        $scope.getAllStores();
    }

    $scope.getAllStores = function() {
        url = api_domain + "/api/all-store";
        $http({
            url: url,
            method: "GET",
            params: {
                api_token,
            },
            header: {
                'Content-Type': 'application/json',
            },
        }).then(
            function(response){
                $scope.allStores = response.data;
                $scope.rebuildStores = [];
                angular.forEach($scope.allStores, function(store, key) {
                    $scope.rebuildStores[store.id] = store;
                });
            }
        );
    }

    $scope.upload = function (file, store) {
        Upload.upload({
            url: api_domain + '/api/upload/images',
            data: {images: [file], api_token}
        }).then(function (resp) {
            $scope.onUploadNewStoreBannerSuccess(resp, store);
        }, function (resp) {
            showMessage('Error', 'Can not upload this images', 'error');
        }, function (evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
        });
    };

    $scope.onUploadNewStoreBannerSuccess = function(resp, store){
        store.banner_url = resp.data[0];
    }


    // Get all config
    $scope.getAllConfigs = function(){
        url = api_domain + "/api/setting/find";
        $http({
            url: url,
            method: "GET",
            params: {
                api_token,
            },
            header: {
                'Content-Type': 'application/json',
            },
        }).then(
            function(response){
                $scope.configs = [];
                angular.forEach(response.data.data, function(value, key) {
                    $scope.configs[value.key] = value;
                });
                if($scope.configs['featureDailyStores']){
                    $scope.featureDailyStoresConfig = JSON.parse($scope.configs['featureDailyStores'].value);
                }
                if($scope.configs['comments']){
                    $scope.commentsConfig = JSON.parse($scope.configs['comments'].value);
                }
                if($scope.configs['storeWidget']){
                    $scope.storeWidgetConfig = JSON.parse($scope.configs['storeWidget'].value);
                }
                if($scope.configs['footer']){
                    $scope.footerConfig = JSON.parse($scope.configs['footer'].value);
                }

            }
        );
    }


    $scope.updateFooterConfig = function(){
        $scope.updateConfig('footer', $scope.footerConfig);
    }


    $scope.updateConfig = function( key, config) {
        var param = {
            key: key,
            api_token: api_token,
            value: JSON.stringify(config),
        };

        $http({
                url: api_domain + "/api/setting/update",
                method: "POST",
                params: param,
                header: {
                    'Content-Type': 'application/json',
                }
            }).then(
                function(response){
                    if (response.data.status != 'successful') {
                        cloneObject($scope.preUpdateParam, param);
                        showMessage("Error", response.data.message, "error");
                    } else {
                        showMessage("Successful", "Update param successful!", "success");
                    }
                }
            );
    }

    $scope.updateFeatureDailyStores = function(){
        $scope.updateConfig('featureDailyStores', $scope.featureDailyStoresConfig);
    }

    $scope.updateComments = function() {

        $scope.updateConfig('comments', $scope.commentsConfig);

    }

    $scope.updateStoreWidget = function() {

            $scope.updateConfig('storeWidget', $scope.storeWidgetConfig);
    }

    $scope.init();


}
