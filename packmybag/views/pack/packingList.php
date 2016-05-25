<?php

$this->title = 'BagPack';
?>

<div class="packingList-index" ng-controller="myBarCtrl">
    <div style="cursor: pointer" class="packingList">
        <div class="show-list-content clearfix animated fadeInRight">
            <div style="position: relative">
                <div class="name-style content-block center-block label-pos-list">
                    <i class="fa fa-arrow-left arrow-pos" data-placement="top" tooltip-placement="right-bottom"
                       uib-tooltip="Back to lists" ng-click="backToLists()">
                    </i>Packing list: <span ng-repeat="list in finalLists">{{list.list_name}}</span>
                </div>
            </div>
            <div class="hr-final-list" ></div>
            <div ng-show="showFinalListContent" class="show-final-list-content clearfix ">
                <div ng-repeat="section in addedStuffs" class="font-style form-group col-md-4 content-style">
                    <div class="content-block" style="text-decoration: underline">
                        {{section.section_name}}
                    </div>
                    <div ng-repeat="stuffs in section.stuffs" class="font-style">
                        <label style="font-weight: 400; cursor: pointer;">
                            <input type="checkbox"
                                   ng-click="selectStuffFinalList(stuffs)"
                                   value="{{stuffs.stuff_name}}"
                                   ng-model="stuffs.selected"
                                   ng-checked="checkedItems.indexOf(stuffs) != -1">
                                <span class="tab"></span>
                            <span ng-show="!stuffs.selected">
                                    <span>{{stuffs.stuff_name}}</span>
                                </span>
                                <span ng-show="stuffs.selected">
                                    <strike>{{stuffs.stuff_name}}</strike>
                                </span>
                        </label>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
