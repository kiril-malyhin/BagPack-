'use strict';

app.controller("myBarCtrl", function($scope,Alertify, $http, $timeout) {


    $scope.showChooseContent = true;
    $scope.showListContent = false;

    $scope.bar = {};

    $scope.radioButtonSetValue = function(key, value){
         $scope.bar[key]=value;
        return;
    }

    $scope.packState = function(){
        $scope.showListContent = true;
        $scope.showChooseContent = false;
    }

    $scope.$watch('bar', function(newValue, oldValue) {

        for(var i in newValue){
            if(newValue[i] != ''){

                console.log(newValue);
                $http.post('index.php?r=stuff/stuffs',{filters:newValue}).success(function(response){
                    $scope.stuffFilters = response;
                    console.log(response);

                }).error(function(error){
                    console.error(error);
                });

                $scope.showListContent = false;
                break;
            }
        }
    }, true);

    $http.post('index.php?r=stuff/category').success(function(response){

        for(var i in response){
            $scope.bar[response.cat_filter_id] = null;
        }
        $scope.categories = response;


    }).error(function(error){
        console.error(error);
    });

    $http.post('index.php?r=stuff/section').success(function(response){

        $scope.sections = response;

    }).error(function(error){
        console.error(error);
    });

});

