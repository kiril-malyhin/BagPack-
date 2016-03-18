<?php

/* @var $this yii\web\View */

$this->title = 'BagPack';
?>

<div class="pack-index" ng-controller="myBarCtrl">
    <div class="row" style=" cursor: pointer" >
        <div class="col-md-2 bar-st clearfix" style="color: white" >
            <div class="choose-bar-block" >
                <div class="center-block animated pulse infinite"><h2>Choose your travel options</h2></div>
                <hr>
                <div ng-repeat="category in categories">
                    <h4>{{category.cat_filter_name}}</h4>
                    <div>
                        <div class="btn-group" id="{{category.cat_filter_id}}" data-toggle="buttons" >
                            <label ng-repeat="filters in category.filters" style="border-radius:20px" class="btn btn-default choose filter-button"
                                   ng-click="radioButtonSetValue(category.cat_filter_id, filters.filter_id)">
                                <input type="radio" name="{{category.cat_filter_id}}"
                                       ng-model="bar[category.cat_filter_id]"
                                       value="{{filters.filter_id}}">
                                <span class="radio-dot"></span>
                                <span class="choose-word">{{filters.filter_name}}</span>
                            </label>
                        </div>
                    </div>
                    <hr>
                </div>


            </div >
        </div>

        <div class="col-md-10">
            <div ng-show="showChooseContent" class="show-choose-content clearfix animated fadeInRightBig">
                <div class="row" style="position: relative">
                    <div class="name-style content-block center-block label-pos">
                        <i class="fa fa-check check-all-pos pull-left" ng-show="checkAllItems"
                           tooltip-placement="bottom" uib-tooltip="Check all" ng-click="checkAll()">
                        </i>
                        <i class="fa fa-close check-all-pos pull-left" ng-show="unCheckAllItems"
                           tooltip-placement="bottom" uib-tooltip="Uncheck all" ng-click="unCheckAll()">
                        </i>
                        <i class="fa fa-refresh refresh " ng-click="refreshPackingList()"
                           tooltip-placement="bottom-left" uib-tooltip="Click to refresh list of stuffs">
                        </i>


                        Packing list
                    </div>
                    <div class="btn-group btn-state">
                        <button type="button" class="btn btn-my-sign pack-button" ng-click="packState()">Pack now</button>
                    </div>
                </div>
                <div class="hr-black"></div>
                <div class="form-group col-md-4 content-style" ng-repeat="section in sections" >
                    <div class="content-block" ng-hide="isSectionHidden(section)">
                        {{section.section_name}}
                    </div>

                    <div ng-show="startStuffs">
                        <div ng-repeat="stuffs in section.stuffs"  style="font-size: 15px">
                            <label style="font-weight: 400; cursor: pointer;">
                                <input type="checkbox"
                                       ng-model="stuffs.selected"
                                       ng-click="selectStuff(stuffs)"
                                value="{{stuffs.stuff_name}}"
                                       ng-checked="checkedItems.indexOf(stuffs) != -1">
                                <span class="tab">

                                </span>{{stuffs.stuff_name}}
                            </label>
                        </div>

                    </div>

                    <div ng-show="filteringStuffs">
                        <div ng-repeat="stuffs in section.stuffs" style="font-size: 15px" ng-hide = "checkItem(stuffs)">
                            <label style="font-weight: 400; cursor: pointer;">
                                <input type="checkbox"
                                       ng-model="stuffs.selected"
                                       ng-click="selectStuff(stuffs)"
                                       value="{{stuffs.stuff_name}}"
                                       ng-checked="checkedItems.indexOf(stuffs) != -1">
                                <span class="tab"></span>{{stuffs.stuff_name}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div ng-show="showListContent" class="show-list-content clearfix animated fadeInRightBig" >
                <div class="row" style="position: relative">
                    <div class="name-style content-block center-block label-pos"><i class="fa fa-arrow-left arrow-pos" ng-click="backToChoose()"></i>List</div>
                    <div class="btn-group btn-state">
                        <button type="button" class="btn btn-my-sign pack-button" data-toggle="dropdown">Save<span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a ng-click="saveToPdf()" >PDF  <span class="glyphicon glyphicon-floppy-disk"></span></a></li>
                            <li><a ng-click="printList()"  >Print  <span class="glyphicon glyphicon-print"></span></a></li>
                            <li class="divider"></li>
                            <li><a ng-click="openList()" >New <span class="glyphicon glyphicon-list"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="hr-black"></div>
                <div class="form-group col-md-4 content-style" ng-repeat="section in sections" >
                    <div class="content-block">
                        {{section.section_name}}
                        <i class="fa fa-plus-circle" ng-click="openNewStuff()"
                           tooltip-placement=top}" uib-tooltip="Click to add new stuff">
                        </i>
                        <div class="no-items">
                            <div ng-show="noStuffsInSection(section)" ng-model="section.section_name">No checked items</div>
                        </div>
                    </div>
                    <div ng-repeat="stuffs in section.stuffs" ng-show="stuffs.selected">
                        <label style="font-weight: 400; cursor: pointer;">
                            <input type="checkbox"
                                    ng-model="stuffs.selected"
                                    value="{{stuffs.stuff_name}}"
                                    ng-checked="checkedItems.indexOf(stuffs) != -1"
                                    ng-click="unSelectStuff(stuffs)">
                            <span class="tab"></span>{{stuffs.stuff_name}}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
