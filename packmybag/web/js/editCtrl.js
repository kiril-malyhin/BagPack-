'use strict';

app.controller("editCtrl", function($scope,Alertify, $http, $timeout, $uibModal, $window,$routeParams) {

    $scope.showEditContent = true;
    $scope.editStuffs = true;
    $scope.filteringEditStuffs = false;
    $scope.startEditStuffs = true;
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
    $scope.refreshListOfItems = true;
    $scope.finalItems = [];
    var userStuffs = [];

    var QueryString = function () {
        // This function is anonymous, is executed immediately and
        // the return value is assigned to QueryString!
        var query_string = {};
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
            var pair = vars[i].split("=");
            // If first entry with this name
            if (typeof query_string[pair[0]] === "undefined") {
                query_string[pair[0]] = decodeURIComponent(pair[1]);
                // If second entry with this name
            } else if (typeof query_string[pair[0]] === "string") {
                var arr = [query_string[pair[0]], decodeURIComponent(pair[1])];
                query_string[pair[0]] = arr;
                // If third or later entry with this name
            } else {
                query_string[pair[0]].push(decodeURIComponent(pair[1]));
            }
        }
        return query_string;
    }();

    var list_ID = QueryString.list_id;

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

        var items = $scope.checkedItems;

        var temp = [];
        for(var item in items){
            temp.push(items[item].stuff_id);
        }

        if(temp.indexOf(stuffs.stuff_id) === -1) {
            $scope.checkedItems.push(stuffs);
        } else {
            $scope.checkedItems.splice($scope.checkedItems.indexOf(stuffs), 1);
        }
    };

    $http.post('index.php?r=stuff/stuffs').success(function(response){
        $scope.stuffFilters = response;

    }).error(function(error){
        console.error(error);
    });

    $scope.backToChoose = function(){
        $scope.showChooseContent = true;
        $scope.showListContent = false;
    };

    $scope.backToLists = function () {
        alertify.confirm("Do You really want to close list? All entered data will be lost!", function (e) {
            if (e) {
                window.location.href = "index.php?r=pack/showlists";
            }
        });
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

    $scope.refreshPackingFinalList = function(){

        $scope.checkedItems = [];

        for(var section in $scope.sections) {
            for(var stuff in $scope.sections[section].stuffs) {
                $scope.sections[section].stuffs[stuff].selected = false;
            }
        }
    };

    $scope.$watch('bar', function(newValue) {
        for(var i in newValue){
            if(newValue[i] != ''){
                $scope.filterValues = newValue;
                $scope.startEditStuffs = false;
                $scope.filteringEditStuffs = true;
                break;
            }
        }
    }, true);

    $scope.checkItem = function(item) {
        var filters = $scope.stuffFilters;
        var filterValues = $scope.filterValues;

        for (var filterValue in filterValues) {
            if (filterValue)
                for (var filter in filters) {
                    if (filters[filter].cat_filter_id == filterValue) {
                        if (filters[filter].filter_id == filterValues[filterValue]) {
                            if (filters[filter].stuff_id == item.stuff_id) {
                                return true;
                            }
                        }
                    }
                }
        }

        return false;
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

    $scope.openNewStuff = function (section, checkedItems) {

        $uibModal.open({

            templateUrl: 'templates/newStuff.html',
            controller: function ($scope, $uibModalInstance) {

                $scope.Cancel = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.autoClose = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.addStuff = function () {

                    var newStuff = {
                        stuff_name: $scope.stuffInfo.stuffName,
                        selected: true
                    };

                    section.stuffs.push(newStuff);
                    checkedItems.push(newStuff);

                    $scope.autoClose();
                    Alertify.success('Stuff was added!');
                };
            },
            size: 'sm',
            resolve:{
                stuffs: function () {
                    return userStuffs;
                },
                sections: function(){
                    return $scope.sections;
                }
            }
        });
    };


    $scope.noStuffsInSection = function(section){
        for (var stuff in section.stuffs) {
            if (section.stuffs[stuff].selected) {
                return false;
            }
        }
        return true;
    };

    $scope.noStuffsInSectionEdit = function(section){
        for (var stuff in section.stuffs) {
            if (section.stuffs[stuff].selected) {
                return false;
            }
        }
        return false;
    };

    $scope.openList = function () {
        var modalInstance = $uibModal.open({

            templateUrl: 'templates/newListForm.html',
            controller: function ($scope, $uibModalInstance, items, filters) {

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
                        selectedItems: items,
                        selectedFilters: filters
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
                },
                filters: function () {
                    return $scope.filterValues;
                }
            }
        });
    };

    $scope.allStuffsSelected = function () {
        for(var section in $scope.sections) {
            for(var stuff in $scope.sections[section].stuffs) {
                if (!$scope.sections[section].stuffs[stuff].selected) {
                    return false;
                }
            }
        }

        return true;
    };

    $http.post('index.php?r=list/current_list', {listID: list_ID}).success(function (response) {

        $scope.finalLists = response;

        var listStuffs = [];
        var listFilters = [];
        var finalLists = $scope.finalLists;

        var finalStuffs = JSON.parse(finalLists[0].list_data);
        for (var finalStuff in finalStuffs) {
            listStuffs.push(finalStuffs[finalStuff].stuff_id);
        }

        $scope.description = finalLists[0].list_name;
        $scope.listName = finalLists[0].list_description;

        var filters = JSON.parse(finalLists[0].list_filter);
        for(var filter in filters){
            if(filters[filter] != null){
                listFilters.push(filters[filter]);
            }
        }
        secondAction(listStuffs);
        checkFilter(listFilters);
    });

    function secondAction (listStuffs) {
        $http.post('index.php?r=list/section').success(function (response) {
            $scope.sectionsContent = {};
            $scope.sectionsFinal = response;
            $scope.checkedQwe = {};



            for(var listItem in listStuffs) {
                for(var section in $scope.sectionsFinal) {
                    if (!$scope.finalItems[section]) {

                        $scope.finalItems[section] = {};
                        $scope.finalItems[section].section_name = $scope.sectionsFinal[section].section_name;
                        $scope.finalItems[section].stuffs = [];
                    }

                    for (var stuff in $scope.sectionsFinal[section].stuffs) {
                        $scope.sectionsFinal[section].stuffs[stuff].selected = true;

                        if ($scope.sectionsFinal[section].stuffs[stuff].stuff_id == listStuffs[listItem]) {

                            $scope.finalItems[section].stuffs.push($scope.sectionsFinal[section].stuffs[stuff]);

                            if ($scope.checkedItems.indexOf($scope.sectionsFinal[section].stuffs[stuff]) === -1) {

                                $scope.checkedItems.push($scope.sectionsFinal[section].stuffs[stuff]);
                            } else {
                                $scope.checkedItems.splice($scope.checkedItems.indexOf($scope.sectionsFinal[section].stuffs[stuff]), 1);
                            }
                        }
                    }
                }
            }
        });
    }

    function checkFilter (listFilters){
        $http.post('index.php?r=stuff/category').success(function(response){

            for(var i in $scope.categories){
                $scope.bar[$scope.categories.cat_filter_id] = null;
            }

            $scope.categories = response;

            var categories = $scope.categories;

            $scope.checked = {};

            for (var category in categories) {
                for(var filter in categories[category].filters){
                    for(var filterItem in listFilters){
                        if(categories[category].filters[filter].filter_id == listFilters[filterItem]){
                            $scope.checked[listFilters[filterItem]] = true;
                        }
                    }
                }
            }
            return false;
        });
    }

    $scope.isSectionEmpty = function (section) {
        for (var stuff in section.stuffs) {
            if($scope.checkItem(section.stuffs[stuff])) {
                return false;
            }
        }

        return true;
    };

    $scope.isChecked = function(stuff_id) {
        var items = $scope.checkedItems;
        var temp = [];
        for(var item in items){
            temp.push(items[item].stuff_id);
        }

        return temp.indexOf(stuff_id) != -1;
    };

    $scope.openUpdate = function (finalLists) {

        var modalInstance = $uibModal.open({

            templateUrl: 'templates/updateListForm.html',
            controller: function ($scope, $uibModalInstance, items, description, listName) {

                $scope.listInfo = {
                    listname: listName,
                    description: description
                };

                $scope.Cancel = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.autoClose = function () {
                    $uibModalInstance.dismiss('Cancel');
                };

                $scope.updateList = function () {

                    var data = {
                        listname: $scope.listInfo.listname,
                        description: $scope.listInfo.description,
                        selectedItems: items,
                        listId: QueryString.list_id
                    };
                        $http.post('index.php?r=list/update_list', data).success(function(response){
                            $scope.autoClose();
                            if(JSON.parse(response) != "bad"){
                                Alertify.success('List successfully updated!');
                            }
                            else {

                                Alertify.error("Error! List was not updated!");
                            }
                        }).error(function(error){
                            console.error(error);
                        });
                };
            },
            size: 'sm',
            resolve: {
                items: function () {
                    return $scope.checkedItems;
                },
                description: function(){
                    return finalLists.list_description;
                },
                listName: function(){
                    return finalLists.list_name;
                }
            }
        });
    };
});

