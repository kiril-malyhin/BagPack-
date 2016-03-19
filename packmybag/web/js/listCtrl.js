'use strict';

app.controller("listCtrl", function($scope,Alertify, $http) {

    $http.post('index.php?r=list/all_lists').success(function(response){

        $scope.lists = response;

    }).error(function(error){
        console.error(error);
    });

    $scope.packList = function(list_id){
        window.location.href = "index.php?r=pack/open_packing_list";
        console.log(list_id);
        $http.post('index.php?r=list/current_list').success(function(response){

        }).error(function(error){
            console.error(error);
        });
    };

    $scope.deleteList = function (list_id){

        alertify.confirm("Doy You really want to delete this list?", function (e) {
            if (e) {
                $http.post('index.php?r=list/delete_list',{listId: list_id}).success(function(response){

                    if(JSON.parse(response) != "bad"){
                        Alertify.success('List successfully deleted!');
                        $http.post('index.php?r=list/all_lists').success(function(response){

                            $scope.lists = response;

                        })
                    }
                }).error(function(error){
                    console.error(error);
                });
            } else {
                Alertify.error("List was not deleted!");
            }
        });

    };

});