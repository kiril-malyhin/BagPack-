'use strict';

app.controller("editCtrl", function($scope,Alertify, $http, $timeout, $uibModal) {

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
    $scope.filterValues = [];
    $scope.checkedItemsFinalList = [];
    $scope.refreshListOfItems = true;
    $scope.finalItems = [];
    $scope.addedStuffs = [];
    var userStuffs = [];
    var temp = [];

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

    var list_ID = QueryString.list_id;

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

    $http.post('index.php?r=stuff/stuffs').success(function(response){
        $scope.stuffFilters = response;

    }).error(function(error){
        console.error(error);
    });

    $http.post('index.php?r=list/current_list', {listID: list_ID}).success(function (response) {

        $scope.finalLists = response;

        var listStuffs = [];
        var listFilters = [];
        var finalLists = $scope.finalLists;

        $scope.resultStuffs = JSON.parse(finalLists[0].list_data);
        var finalStuffs = $scope.resultStuffs;
        for (var section in finalStuffs) {

            for(var stuff in finalStuffs[section].stuffs) {
                listStuffs.push(finalStuffs[section].stuffs[stuff]);
                $scope.addedStuffs.push(finalStuffs[section].stuffs[stuff]);
            }
        }

        //console.log($scope.addedStuffs);
        //console.log(finalStuffs);

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

    $scope.radioButtonSetValue = function(key, value){
        $scope.bar[key]=value;
        return;
    };

    $scope.selectStuffFinalList = function(stuffs, sectionName){
        //console.log(stuffs);
        var items = $scope.checkedItems;
        //console.log(stuffs);

        var temp = [];
        for(var item in items){
            temp.push(items[item].stuff_id);
        }

        //console.log(temp);

        var sectionFound = false;
        var sectionObject = {};

        for(var section in $scope.checkedItems) {
            if ($scope.checkedItems[section].section_name == sectionName) {
                sectionFound = true;

                if ($scope.checkedItems[section].stuffs.indexOf(stuffs) === -1) {
                    $scope.checkedItems[section].stuffs.push(stuffs);
                } else {
                    $scope.checkedItems[section].stuffs.splice($scope.checkedItems[section].stuffs.indexOf(stuffs), 1);
                }

            }
            //console.log($scope.checkedItems[section].stuffs);
        }


        if (sectionFound == false) {
            sectionObject = { section_name: sectionName, stuffs: [stuffs] };
            $scope.checkedItems.push(sectionObject);
        }
    };

    $scope.backToLists = function () {
        alertify.confirm("Do You really want to close list? All entered data will be lost!", function (e) {
            if (e) {
                window.location.href = "index.php?r=pack/showlists";
            }
        });
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

    $scope.openNewStuff = function (section) {

        $uibModal.open({

            templateUrl: 'templates/site/newStuff.html',
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
                        selected: true,
                        stuff_id: section.stuffs.length * (-1)
                    };

                    section.stuffs.push(newStuff);

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

    $scope.openList = function () {
        $uibModal.open({

            templateUrl: 'templates/site/newListForm.html',
            controller: function ($scope, $uibModalInstance, items, filters, stuffs) {

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
                    else if(items.stuffs == 0){
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

                        if ($scope.sectionsFinal[section].stuffs[stuff].stuff_id == listStuffs[listItem].stuff_id || $scope.sectionsFinal[section].stuffs[stuff].stuff_id < 0) {

                            $scope.finalItems[section].stuffs.push($scope.sectionsFinal[section].stuffs[stuff]);

                            $scope.selectStuffFinalList($scope.sectionsFinal[section].stuffs[stuff], $scope.sectionsFinal[section].section_name);
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
                            $scope.filterValues.push(listFilters[filterItem]);
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
    };

    $scope.isChecked = function(stuff_id) {

        for(var stuffs in $scope.addedStuffs){
            //for(var stuff in $scope.checkedItems[section].stuffs) {
            //    ($scope.checkedItems[section].stuffs[stuff].stuff_id);
            //}
            temp.push($scope.addedStuffs[stuffs].stuff_id);
        }

        return temp.indexOf(stuff_id) != -1;
    };

    $scope.openUpdate = function (finalLists) {

        $uibModal.open({

            templateUrl: 'templates/site/updateListForm.html',
            controller: function ($scope, $uibModalInstance, items, description, listName, filters) {

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
                        listId: QueryString.list_id,
                        selectedFilters: filters
                    };
                    if(items != 0){
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
                    }else if(items == 0){
                        $scope.autoClose();
                        Alertify.alert('Your list is empty! You should check at least 1 item!')
                    }
                };
            },
            size: 'sm',
            resolve: {
                items: function () {
                    console.log($scope.checkedItems);
                    return $scope.checkedItems;
                },
                description: function(){
                    return finalLists.list_description;
                },
                listName: function(){
                    return finalLists.list_name;
                },
                filters: function(){
                    return $scope.filterValues;
                }
            }
        });
    };
});

