app.controller("signCtrl", function($scope, $http, $state, Alertify,$uibModal) {

    $scope.openSign = function (size) {
        $uibModal.open({

            templateUrl: 'templates/user/signForm.html',
            controller: function ($scope, $uibModalInstance) {

                $scope.signUpInfo = {
                    username: undefined,
                    user_email: undefined,
                    password: undefined
                };

                $scope.Cancel = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.autoClose = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.signUserUp = function (){
                    var data = {
                        username: $scope.signUpInfo.username,
                        user_email: $scope.signUpInfo.user_email,
                        password: $scope.signUpInfo.password
                    };

                    $http.post('index.php?r=sign/sign', data).success(function(response){

                        console.log(response);

                        if(JSON.parse(response) != "bad"){
                            $scope.autoClose();
                            Alertify.success('Success registration!');
                        }
                        else {

                            Alertify.error("Error! User with such name exists!");
                        }
                    }).error(function(error){
                        console.error(error);
                    });
                };
            },
            size: size
        });
    };
});