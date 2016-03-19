'use strict';

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
            controller: function ($scope, $uibModalInstance) {

                $scope.Cancel = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.autoClose = function () {
                    $uibModalInstance.dismiss('Cancel');
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
            },
            size: 'sm'
        });

    };


});
