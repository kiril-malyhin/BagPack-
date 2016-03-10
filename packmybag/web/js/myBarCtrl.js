'use strict';

app.controller("myBarCtrl", function($scope,Alertify, $http, $timeout) {

    $scope.showChooseContent = true;
    $scope.showListContent = false;
    $scope.startStuffs = true;
    $scope.filteringStuffs = false;
    $scope.bar = [];
    $scope.stuffFilters = {};
    $scope.filterValues = {};
    $scope.enabledStuff = [];

    $scope.radioButtonSetValue = function(key, value){
         $scope.bar[key]=value;
        return;
    };

    $scope.packState = function(){
        $scope.showListContent = true;
        $scope.showChooseContent = false;
    };

    $http.post('index.php?r=stuff/stuffs').success(function(response){
        $scope.stuffFilters = response;
        //console.log($scope.stuffFilters);

    }).error(function(error){
        console.error(error);
    });

    $http.post('index.php?r=stuff/category').success(function(response){

        for(var i in response){
            $scope.bar[response.cat_filter_id] = null;
        }
        $scope.categories = response;


    }).error(function(error){
        console.error(error);
    });

    $scope.backToChoose = function(){
        $scope.showChooseContent = true;
        $scope.showListContent = false;
    };

    $http.post('index.php?r=stuff/section').success(function(response){

        $scope.sections = response;

    }).error(function(error){
        console.error(error);
    });


    $scope.$watch('bar', function(newValue, oldValue) {
        for(var i in newValue){
            if(newValue[i] != ''){
                $scope.filterValues = newValue;
                $scope.startStuffs = false;
                $scope.filteringStuffs = true;
                break;
            }
        }
    }, true);

    $scope.checkItem = function(item) {
        var filters = $scope.stuffFilters;
        var filterValues = $scope.filterValues;

        for (var filterValue in filterValues) {
            //console.log(filterValues[filterValue]);
            for (var filter in filters) {
                //console.log(filterValues[filterValue]);
                //console.log(filters[filter]);
                if (filters[filter].filter_id == filterValues[filterValue]) {
                    for (var stuff in filters[filter].stuff_id) {
                        //console.log(filters[filter].stuff_id);
                        if (filters[filter].stuff_id == item.stuff_id ) {
                           // console.log(stuffValues);
                            //console.log(item.stuff_id);
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    };



});

