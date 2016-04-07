app.controller("paymentCtrl", function($scope, $http, $state, Alertify,$uibModal) {

    $scope.openPremiumAccount = function () {
        $uibModal.open({
            templateUrl: 'templates/site/paymentForm.html',
            controller: function ($scope, $uibModalInstance) {

                $scope.Cancel = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.autoClose = function () {
                    $uibModalInstance.dismiss('Cancel');
                };
            },
            size: 'sm'
        });
    };
});