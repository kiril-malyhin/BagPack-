'use strict';

app.controller("listCtrl", function($rootScope,$scope,Alertify, $http) {

    $scope.testNumber = 3;

    $http.post('index.php?r=list/all_lists').success(function(response){

        $scope.lists = response;
    });

    $http.post('index.php?r=list/user_name').success(function(response){
        $scope.userName = response;
    });

    $scope.packList = function(list_id){
        window.location.href = "index.php?r=pack/open_packing_list&list_id="+list_id;
    };

    $scope.editList = function(list_id){
        window.location.href = "index.php?r=pack/edit_list&list_id="+list_id;
    };

    $scope.deleteList = function (list_id){

        alertify.confirm("Do You really want to delete this list?", function (e) {
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