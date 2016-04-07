app.controller("loginCtrl", function($scope, $http, $state, $timeout,Alertify,$uibModal){

    $scope.openLogin = function (size) {

        var modalInstance = $uibModal.open({
            templateUrl: 'templates/user/loginForm.html',
            controller: function ($scope, $uibModalInstance) {

                $scope.loginInfo = {
                    username: undefined,
                    password: undefined,
                    restore_password: undefined
                };

                $scope.isCollapsed = true;

                $scope.Cancel = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.autoClose = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.restorePassword = function() {
                    var data = {
                        restore_password: $scope.loginInfo.restore_password
                    };

                    $http.post('index.php?r=login/restore_password', data).success(function(response){
                        console.log(response);
                        if(response == 1){

                            Alertify.success('Success! Mail was sended. Check Your mail!');
                            $scope.loginInfo = {
                                restore_password: undefined
                            }
                        }
                        else if(response == 0){

                            Alertify.error('Error! Check input data!');
                        }
                    }).error(function(error){
                        console.error(error);
                    });
                };

                $scope.loginUser = function () {
                    var data = {
                        username: $scope.loginInfo.username,
                        password: $scope.loginInfo.password,
                        rememberUser: $scope.loginInfo.rememberUser
                    };
                    $http.post('index.php?r=login/login', data).success(function(response){
                        $scope.user = response;
                        if(response != 'false'){
                            $scope.autoClose();
                            Alertify.success('Success login! Now You will be redirected to the main page!');
                            $timeout(function(){
                                window.location.href = "index.php?r=pack/create";
                            },2000);
                        }
                        else {

                            Alertify.error('Error! Check username or password!');
                        }
                    }).error(function(error){
                        console.error(error);
                    });
                }
            },
            size: size
        });

    };
})