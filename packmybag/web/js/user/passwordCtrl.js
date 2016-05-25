app.controller("passwordCtrl", function($scope, $http, $state, Alertify,$uibModal, $timeout) {

    $scope.restorePage = true;

    $scope.restoreInfo = {
        password: undefined,
        confirmPassword: undefined
    };

    $scope.openChangePassword = function () {
        $uibModal.open({

            templateUrl: 'templates/user/changePasswordForm.html',
            controller: function ($scope, $uibModalInstance) {

                $scope.changePasswordInfo = {
                    password: undefined,
                    new_password: undefined
                };

                $scope.Cancel = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.autoClose = function () {
                    $uibModalInstance.dismiss('Cancel');
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
            },
            size: 'sm'
        });
    };

    $scope.saveNewPassword = function(){

        var QueryString = function () {
            var query_string = {};
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split("=");
                if (typeof query_string[pair[0]] === "undefined") {
                    query_string[pair[0]] = decodeURIComponent(pair[1]);
                } else if (typeof query_string[pair[0]] === "string") {
                    var arr = [query_string[pair[0]], decodeURIComponent(pair[1])];
                    query_string[pair[0]] = arr;
                } else {
                    query_string[pair[0]].push(decodeURIComponent(pair[1]));
                }
            }
            return query_string;
        }();
        var user_name = QueryString.name;

        var data = {
            password: $scope.restoreInfo.password,
            confirmPassword: $scope.restoreInfo.confirmPassword,
            userName: user_name
        };

        $http.post('index.php?r=site/restore_password', data).success(function(response){

            if(JSON.parse(response) != "bad"){
                $scope.restorePage = false;
                Alertify.alert("Password was changed! Now You will be redirected to the main page!");
                $timeout(function(){
                    window.location.href = "index.php";
                },2000);
            }
            else {

                Alertify.error("Error!");
            }


        });
    }
});