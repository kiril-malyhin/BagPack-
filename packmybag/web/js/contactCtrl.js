'use strict';

app.controller("contactCtrl", function($scope,Alertify, $http) {

    $scope.contactInfo = {
        first_name: undefined,
        last_name: undefined,
        email: undefined,
        comments: undefined
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