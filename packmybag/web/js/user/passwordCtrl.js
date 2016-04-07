app.controller("passwordCtrl", function($scope, $http, $state, Alertify,$uibModal) {

    $scope.openChangePassword = function () {
        $uibModal.open({

            templateUrl: 'templates/user/changePasswordForm.html',
            controller: function ($scope, $uibModalInstance) {

                $scope.changePasswordInfo = {
                    password: undefined,
                    new_password: undefined
                };

                $scope.Cancel = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.autoClose = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.changePassword = function (){
                    var data = {
                        password: $scope.changePasswordInfo.password,
                        new_password: $scope.changePasswordInfo.new_password
                    };

                    $http.post('index.php?r=site/change_password', data).success(function(response){

                        if(JSON.parse(response) != "bad"){
                            $scope.autoClose();
                            Alertify.success('Password successfully changed!');
                        }
                        else {

                            Alertify.error("Error! Check input data!");
                        }
                    }).error(function(error){
                        console.error(error);
                    });
                };
            },
            size: 'sm'
        });

    };
});