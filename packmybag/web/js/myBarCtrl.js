'use strict';

app.controller("myBarCtrl", function($scope) {
    $scope.showStartContent = true;
    $scope.showChooseContent = false;
    $scope.showListContent = false

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

});

$(function() {
    $('#modalLoginButton').click(function (){
        $('#modal-login').modal('show')
            .find('#modalLoginContent')
            .load($(this).attr('value'));

    });

    $('#modalSignUpButton').click(function (){
        $('#modal-sign').modal('show')
            .find('#modalSignUpContent')
            .load($(this).attr('value'));
    });
});
