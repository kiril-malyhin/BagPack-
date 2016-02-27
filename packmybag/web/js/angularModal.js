'use strict';

app.controller("LoginController", function($scope, $http, $state, $timeout,Alertify,$uibModal, $log){




    $scope.loginInfo = {
        username: undefined,
        password: undefined
    }

    $scope.openLogin = function (size) {

        var modalInstance = $uibModal.open({
            templateUrl: 'templates/loginForm.html',
            controller: 'ModalInstanceCtrl',
            size: size
        });

        modalInstance.result.then(function () {
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    }

    $scope.loginUser = function () {
        var data = {
            username: $scope.loginInfo.username,
            password: $scope.loginInfo.password
        }
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
})

app.controller("SignController", function($scope, $http, $state, Alertify,$uibModal, $log) {

    //Variables
    $scope.signUpInfo = {
        username: undefined,
        password: undefined
    }

    $scope.openSign = function (size) {
        var modalInstance = $uibModal.open({

            templateUrl: 'templates/signForm.html',
            controller: 'ModalInstanceCtrl',
            size: size
        });

        modalInstance.result.then(function () {
        }, function () {
            $log.info('Modal dismissed at: ' + new Date());
        });
    };

    $scope.signUserUp = function (){
        var data = {
            username: $scope.signUpInfo.username,
            password: $scope.signUpInfo.password
        }

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



})

app.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance) {

    $scope.Cancel = function () {
        $uibModalInstance.dismiss('Cancel');
    };

    $scope.autoClose = function () {
        $uibModalInstance.dismiss('Cancel');
    };
});
