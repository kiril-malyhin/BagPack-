'use strict';

app.controller("LoginController", function($scope, $http, $state, $timeout,Alertify,$uibModal, $log){

    $scope.isCollapsed = true;

    $scope.loginInfo = {
        username: undefined,
        password: undefined,
        restore_password: undefined
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

    $scope.restorePassword = function() {
        var data = {
            restore_password: $scope.loginInfo.restore_password
        }
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
        user_email: undefined,
        password: undefined
    };

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
            user_email: $scope.signUpInfo.user_email,
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

});

app.controller("PasswordController", function($scope, $http, $state, Alertify,$uibModal, $log) {

    $scope.changePasswordInfo = {
        password: undefined,
        new_password: undefined
    };

    $scope.openChangePassword = function (size) {
        var modalInstance = $uibModal.open({

            templateUrl: 'templates/changePasswordForm.html',
            controller: 'ModalInstanceCtrl',
            size: 'sm'
        });

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

});

app.controller("contactCtrl", function($scope, $http, $state, $timeout,Alertify,$uibModal) {

    $scope.contactInfo = {
        first_name: undefined,
        last_name: undefined,
        email: undefined,
        comments: undefined
    };


    $scope.openContact = function (size) {
        var modalInstance = $uibModal.open({

            templateUrl: 'templates/contactForm.html',
            controller: 'ModalInstanceCtrl',
            size: size
        });

    };

    $scope.contactUs = function (){
        var data = {

            first_name: $scope.contactInfo.first_name,
            company: $scope.contactInfo.company,
            email: $scope.contactInfo.email,
            phone: $scope.contactInfo.phone,
            comments: $scope.contactInfo.comments
        };

        $http.post('index.php?r=site/contact_us', data).success(function(response){

            console.log(response);
            if(JSON.parse(response) != "bad"){

                $scope.autoClose();

                Alertify.alert('Email successfully sent! Please, check Your mail and follow the instructions');

                $scope.contactInfo = {
                    first_name: undefined,
                    last_name: undefined,
                    email: undefined,
                    comments: undefined
                }
            }
            else {

                Alertify.error("Error! Email was not sent!");
            }
        }).error(function(error){
            console.error(error);
        });
    };




});

app.controller("PaymentController", function($scope, $http, $state, Alertify,$uibModal, $log) {

    $scope.openPremiumAccount = function (size) {
        var modalInstance = $uibModal.open({

            templateUrl: 'templates/paymentForm.html',
            controller: 'ModalInstanceCtrl',
            size: 'sm'
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
