system.controller("HeaderController", HeaderController);
/**
 *
 * @param {type} $scope
 * @param {type} $http
 * @param {type} $rootScope
 * @returns {undefined}
 */
function HeaderController($scope, $http, $rootScope, $timeout, Upload, $interval) {
    $scope.controllerName = "HeaderController";


    $interval(function(){
        $scope.time = moment().tz("America/New_York").format("HH:mm:ss A");
        $scope.day = moment().tz("America/New_York").format("MM/DD/YYYY");
    }, 1000);


}
