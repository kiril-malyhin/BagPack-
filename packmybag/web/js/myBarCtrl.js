'use strict';

app.controller("myBarCtrl", function($scope,Alertify, $http, $timeout, $uibModal, $window, theService) {

    $scope.showChooseContent = true;
    $scope.showListContent = false;
    $scope.startStuffs = true;
    $scope.filteringStuffs = false;
    $scope.showFinalListContent = true;
    $scope.bar = [];
    $scope.stuffExist = [];
    $scope.stuffFilters = {};
    $scope.filterValues = {};
    $scope.enabledStuff = [];
    $scope.existStuffs = false;
    $scope.sectionName = {};
    $scope.checkedItems = [];
    $scope.checkedItemsFinalList = [];
    $scope.unCheckAllItems = false;
    $scope.checkAllItems = true;
    $scope.unCheckAllItemsFinalList = false;
    $scope.checkAllItemsFinalList = true;
    $scope.refreshListOfItems = true;

    $scope.listInfo = {
        listname: undefined,
        description: undefined
    };

    $scope.radioButtonSetValue = function(key, value){
         $scope.bar[key]=value;
        return;
    };

    $scope.selectStuff = function(stuffs){

        if ($scope.checkedItems.indexOf(stuffs) === -1) {
            $scope.checkedItems.push(stuffs);
        } else {
            $scope.checkedItems.splice($scope.checkedItems.indexOf(stuffs), 1);
        }
    };

    $scope.selectStuffFinalList = function(stuffs){

        if ($scope.checkedItems.indexOf(stuffs) === -1) {
            $scope.checkedItems.push(stuffs);
        } else {
            $scope.checkedItems.splice($scope.checkedItems.indexOf(stuffs), 1);
        }
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

    $scope.backToLists = function(){
        window.location.href = "index.php?r=pack/showlists";
    };

    $http.post('index.php?r=stuff/section').success(function(response){

        $scope.sections = response;
        for(var section in $scope.sections) {
            for(var stuff in $scope.sections[section].stuffs) {
                $scope.sections[section].stuffs[stuff].selected = false;
            }
        }

    }).error(function(error){
        console.error(error);
    });

    $scope.unSelectStuff = function(stuffs){
        stuffs.selected = false;
    };

    $scope.refreshPackingList = function(){

        $scope.checkedItems = [];
        $scope.unCheckAllItems = false;
        $scope.checkAllItems = true;

        $http.post('index.php?r=stuff/section').success(function(response){

            $scope.sections = response;
            for(var section in $scope.sections) {
                for(var stuff in $scope.sections[section].stuffs) {
                    $scope.sections[section].stuffs[stuff].selected = false;
                }
            }

        }).error(function(error){
            console.error(error);
        });
    };

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
            if(filterValue)
            for (var filter in filters) {
                if (filters[filter].cat_filter_id == filterValue) {
                    if (filters[filter].filter_id != filterValues[filterValue]) {
                        if (filters[filter].stuff_id == item.stuff_id) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    };

    $scope.checkAll = function(stuffs){

        for(var section in $scope.sections) {
            for(var stuff in $scope.sections[section].stuffs) {
                $scope.checkedItems.push($scope.sections[section].stuffs[stuff]);
                $scope.sections[section].stuffs[stuff].selected = true;
            }
        }
        $scope.unCheckAllItems = true;
        $scope.checkAllItems = false;
    };

    $scope.unCheckAll = function(){
        $scope.checkedItems = [];
        $scope.unCheckAllItems = false;
        $scope.checkAllItems = true;

        for(var section in $scope.sections) {
            for(var stuff in $scope.sections[section].stuffs) {
                $scope.checkedItems.push($scope.sections[section].stuffs[stuff]);
                $scope.sections[section].stuffs[stuff].selected = false;
            }
        }
    };

    $scope.checkAllFinalList = function(){
        for(var section in $scope.sections) {
            for(var stuff in $scope.sections[section].stuffs) {
                $scope.sections[section].stuffs[stuff].selected = true;
            }
        }
        $scope.unCheckAllItemsFinalList = true;
        $scope.checkAllItemsFinalList = false;
    };

    $scope.unCheckAllFinalList = function(){
        for(var section in $scope.sections) {
            for(var stuff in $scope.sections[section].stuffs) {
                $scope.sections[section].stuffs[stuff].selected = false;
            }
        }

        $scope.unCheckAllItemsFinalList = false;
        $scope.checkAllItemsFinalList = true;
    };

    $scope.isSectionHidden = function(section) {

        var filters = $scope.stuffFilters;
        var filterValues = $scope.filterValues;

        for (var filterValue in filterValues) {
            for (var filter in filters) {
                if (filters[filter].cat_filter_id == filterValue){
                    if (filters[filter].filter_id != filterValues[filterValue]) {
                        if (filters[filter].filter_name == section.section_name) {
                            return true;
                        }
                    }
                }

            }
        }
        return false;
    };

    $scope.openNewStuff = function () {

        $uibModal.open({

            templateUrl: 'templates/newStuff.html',
            controller: 'ModalInstanceCtrl',
            size: 'sm'
        });
    };

    $scope.addStuff = function (){
        var data = {
            stuffName: $scope.stuffInfo.stuffName
        };
        $scope.autoClose();
        Alertify.success('Stuff was added!');
    };

    $scope.packState = function(){
        $scope.showListContent = true;
        $scope.showChooseContent = false;

    };

    $scope.noStuffsInSection = function(section){
        for (var stuff in section.stuffs) {
          if (section.stuffs[stuff].selected) {
              return false;
          }
        }
        return true;
    };

    $scope.openList = function () {
        var modalInstance = $uibModal.open({

            templateUrl: 'templates/newListForm.html',
            controller: function ($scope, $uibModalInstance, items) {

                $scope.Cancel = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.autoClose = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.newList = function (){

                    var data = {
                        listname: $scope.listInfo.listname,
                        description: $scope.listInfo.description,
                        selectedItems: items
                    };

                    if(items != 0){
                        $http.post('index.php?r=list/create_list', data).success(function(response){

                            if(JSON.parse(response) != "bad"){
                                $scope.autoClose();
                                Alertify.success('List successfully created!');
                            }
                            else {

                                Alertify.error("Error! List with such name exists!");
                            }
                        }).error(function(error){
                            console.error(error);
                        });
                    }
                    else if(items == 0){
                        $scope.autoClose();
                        Alertify.alert('Your list is empty! You should check at least 1 item!')
                    }
                };
            },
            size: 'sm',
            resolve: {
                items: function () {
                    return $scope.checkedItems;
                }
            }
        });
    };

    $scope.packAlert = function(){
        Alertify.success('Your Bag has been packed!');
    };

    $scope.allStuffsSelected = function () {
        for(var section in $scope.sections) {
            for(var stuff in $scope.sections[section].stuffs) {
                if (!$scope.sections[section].stuffs[stuff].selected) {
                    return false;
                };
            }
        }

        return true;
    };

    $scope.saveToPdf = function(){

    };

    $scope.printList = function(){

        var table = document.getElementById('printArea').innerHTML;
        var myWindow = $window.open('', '', 'width=1000, height=800');
        myWindow.document.write(table);
        myWindow.print();
    };

    /*$http.post('index.php?r=list/current_list', {listId: $routeParams.list_id}).success(function(response){

        $scope.finalLists = response;
        console.log($scope.finalLists);
    });*/

    $http.post('index.php?r=list/section').success(function(response){

        $scope.finalSections = response;
        $scope.name = theService.thing;
        console.log(name);
        /*for(var section in $scope.sections) {
         for(var stuff in $scope.sections[section].stuffs) {
         $scope.sections[section].stuffs[stuff].selected = false;
         }
         }*/
    });

});

