'use strict';

app.controller("myBarCtrl", function($scope,Alertify) {
    $scope.showStartContent = true;
    $scope.showChooseContent = false;
    $scope.showListContent = false;

    $scope.bar = {gender: '',
        temperature: '',
        period: '',
        aim: '',
        transport:''};

    $scope.radioButtonSetValue = function(model, key, value){
        model[key]=value;
        return;
    }

    $scope.$watch('bar', function(newValue, oldValue) {

        for(var i in newValue){
            if(newValue[i] != ''){
                $scope.showChooseContent = true;
                $scope.showStartContent = false;
                break;
            }
        }
    }, true);

    //setTimeout(function(){ Alertify.alert('Choose some filters to see required checkboxes')}, 2000);



});

