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
                <div ng-if="section.stuffs.length > 0" class="form-group col-md-4 content-style" ng-repeat="section in finalItems" >
                    <div class="packListContainer">
                        <div class="content-block">
                            {{section.section_name}}
                            <div class=" col-md-11 hr-section"></div>
                        </div>
<!--                        <div ng-repeat="stuffs in section.stuffs" class="font-style">-->
<!--                            <label style="font-weight: 400; cursor: pointer;">-->
<!--                                <input type="checkbox"-->
<!--                                       ng-click="selectStuffFinalList(stuffs)"-->
<!--                                       value="{{stuffs.stuff_name}}"-->
<!--                                       ng-model="stuffs.selected"-->
<!--                                       ng-checked="checkedItems.indexOf(stuffs) != -1">-->
<!--                                <span class="tab"></span>-->
<!--                                <span ng-show="stuffs.selected">-->
<!--                                    <strike>{{stuffs.stuff_name}}</strike>-->
<!--                                </span>-->
<!--                                <span ng-show="!stuffs.selected">-->
<!--                                    <span>{{stuffs.stuff_name}}</span>-->
<!--                                </span>-->
<!--                            </label>-->
<!--                        </div>-->
                         <div ng-repeat="stuffs in addedStuffs" class="font-style">
                            <label style="font-weight: 400; cursor: pointer;">
                                <input type="checkbox"
                                       ng-click="selectStuffFinalList(stuffs)"
                                       value="{{stuffs.stuff_name}}"
                                       ng-model="stuffs.selected"
                                       ng-checked="checkedItems.indexOf(stuffs) != -1">
                                <span class="tab"></span>
                                <span ng-show="!stuffs.selected">
                                    <strike>{{stuffs.stuff_name}}</strike>
                                </span>
                                <span ng-show="stuffs.selected">
                                    <span>{{stuffs.stuff_name}}</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
