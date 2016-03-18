<?php

/* @var $this yii\web\View */

$this->title = 'BagPack';
?>

<div class="packingList-index" ng-controller="myBarCtrl">
    <div class="row" style=" cursor: pointer;" >
        <div class="show-list-content clearfix animated fadeInRightBig container">
            <div class="row" style="position: relative">
                <div class="name-style content-block center-block label-pos">
                    <i class="fa fa-arrow-left arrow-pos" data-placement="top" tooltip-placement="right-bottom"
                       uib-tooltip="Back to lists" ng-click="backToLists()">
                    </i>Pack Your Bag
                    <i class="fa fa-refresh refresh-pos" ng-click="refreshPackingList()"
                        tooltip-placement="bottom-left" uib-tooltip="Click to refresh list of stuffs">
                    </i>
                    <i class="fa fa-check " ng-show="checkAllItemsFinalList"
                       tooltip-placement="bottom" uib-tooltip="Check all" ng-click="checkAllFinalList()">
                    </i>
                    <i class="fa fa-close" ng-show="unCheckAllItemsFinalList"
                       tooltip-placement="bottom" uib-tooltip="Uncheck all" ng-click="unCheckAllFinalList()">
                    </i>
                </div>
            </div>
            <div class="hr-final-list"></div>
            <div ng-show="showFinalListContent" class="show-final-list-content clearfix ">
                <div class="form-group col-md-4 content-style" ng-repeat="section in sections" >
                    <div class="packListContainer">
                        <div class="content-block">
                            {{section.section_name}}
                            <div class=" col-md-11 hr-section"></div>
                        </div>
                        <div ng-repeat="stuffs in section.stuffs">
                            <label style="font-weight: 400; cursor: pointer;">
                                <input type="checkbox"
                                       ng-click="selectStuffFinalList(stuffs)"
                                       value="{{stuffs.stuff_name}}"
                                       ng-model="stuffs.selected"
                                       ng-checked="checkedItems.indexOf(stuffs) != -1">
                                <span class="tab"></span>
                                <span ng-show="stuffs.selected">
                                    <strike>{{stuffs.stuff_name}}</strike>
                                </span>
                                <span ng-show="!stuffs.selected">
                                    <span>{{stuffs.stuff_name}}</span>
                                </span>
                            </label>
                        </div>
                        <span ng-if="allStuffsSelected()">
                            </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
