<?php

$this->title = 'BagPack';
?>

<div class="pack-index" ng-controller="myBarCtrl">
    <div class="row" style=" cursor: pointer" >
        <div class="col-md-2 bar-st clearfix" style="color: white" >
            <div class="choose-bar-block" >
                <div class="center-block animated pulse infinite">
                    <h2>Choose your travel options</h2>
                </div>
                <hr>
                <div ng-repeat="category in categories">
                    <h4>{{category.cat_filter_name}}</h4>
                    <div>
                        <div class="btn-group" id="{{category.cat_filter_id}}" data-toggle="buttons" >
                            <label ng-repeat="filters in category.filters" style="border-radius:20px;" class="btn btn-default choose filter-button button-mob"
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

        <div class="hr-bar-stuffs"></div>

        <div class="col-md-10">
            <div ng-show="showChooseContent" class="show-choose-content clearfix animated fadeInRight" id="main-page">
                <div style="position: relative">
                    <div class="name-style content-block center-block label-pos">
                        Packing list
                        <i class="fa fa-refresh refresh " ng-click="refreshPackingList()"
                           tooltip-placement="bottom-left" uib-tooltip="Click to refresh list of stuffs">
                        </i>
                    </div>
                    <div class="btn-group btn-state">
                        <button type="button" class="btn btn-my-sign pack-button" ng-click="packState()">Pack now</button>
                    </div>
                </div>

                <div class="hr-black"></div>

                <div ng-show="startStuffs">
                    <div class="form-group col-md-4 content-style" ng-repeat="section in sections" >
                        <div ng-hide="section.section_name == 'Active' || section.section_name == 'Leisure' || section.section_name == 'Cognitive'">
                        <div class="content-block" ng-hide="isSectionHidden(section)" style="text-decoration: underline">
                            {{section.section_name}}
                        </div>

                        <div ng-repeat="stuffs in section.stuffs"  class="font-style">
                            <label style="cursor: pointer">
                                <input type="checkbox"
                                       ng-model="stuffs.selected"
                                       ng-click="selectStuff(stuffs, section.section_name)"
                                value="{{stuffs.stuff_name}}"
                                       ng-checked="checkedItems.indexOf(stuffs) != -1">
                                <span class="tab">

                                </span>{{stuffs.stuff_name}}
                            </label>
                        </div>
                        </div>
                    </div>
                </div>

                <div ng-show="filteringStuffs">
                    <div class="form-group col-md-4 content-style" ng-if="section.stuffs.length > 0"  ng-repeat="section in sections" >
                        <div ng-hide="section.section_name == 'Active' || section.section_name == 'Leisure' || section.section_name == 'Cognitive'"></div>
                        <div class="content-block" ng-hide="isSectionHidden(section)">
                            {{section.section_name}}
                            <div class="no-items">
                                <div ng-if="isSectionEmpty(section)" class="font-style" ng-model="section.section_name">No items</div>
                            </div>
                        </div>

                        <div ng-repeat="stuffs in section.stuffs" class="font-style" ng-show = "checkItem(stuffs)">
                            <label style="cursor: pointer">
                                <input type="checkbox"
                                       ng-model="stuffs.selected"
                                       ng-click="selectStuff(stuffs, section.section_name)"
                                       value="{{stuffs.stuff_name}}"
                                       ng-checked="checkedItems.indexOf(stuffs) != -1">
                                <span class="tab"></span>{{stuffs.stuff_name}}
                            </label>
                            <div class="no-items">
                                <div ng-if="section.stuffs.length == 0" ng-model="section.section_name">No items</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div ng-show="showListContent" class="show-list-content clearfix animated fadeInRight" >
                <div style="position: relative">
                    <div class="name-style content-block center-block label-pos-list"><i class="fa fa-arrow-left arrow-pos" ng-click="backToChoose()"></i>List</div>
                    <div class="btn-group btn-state">
                        <button type="button" class="btn btn-my-sign pack-button" data-toggle="dropdown">Save<span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a ng-click="printDiv('printable')"  >Print  <span class="glyphicon glyphicon-print"></span></a></li>
                            <li class="divider"></li>
                            <li><a ng-click="openList()" >New <span class="glyphicon glyphicon-list"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="hr-black"></div>
                <div id="non-printable">
                    <div class="form-group col-md-4 content-style" ng-repeat="section in sections">
                        <div class="content-block" style="text-decoration: underline">
                            {{section.section_name}}
                            <i class="fa fa-plus-circle" style="
                        color: #b50006" ng-click="openNewStuff(section, checkedItems)"
                               tooltip-placement=top}" uib-tooltip="Click to add new stuff">
                            </i>
                        </div>
                        <div class="no-items content-block">
                            <div ng-show="noStuffsInSection(section)" ng-model="section.section_name" >No checked items</div>
                        </div>
                        <div ng-repeat="stuffs in section.stuffs" ng-show="stuffs.selected" class="font-style">
                            <label style="cursor: pointer" class="font-style">
                                <input type="checkbox"
                                       ng-model="stuffs.selected"
                                       value="{{stuffs.stuff_name}}"
                                       ng-click="selectStuff(stuffs, section.section_name)"
                                       ng-checked="checkedItems.indexOf(stuffs) != -1">
                                <span class="tab"></span>{{stuffs.stuff_name}}
                            </label>
                        </div>
                    </div>
                </div>
                <div id="printable">
                    <div class="name-style content-block center-block label-pos">List of stuffs</div>
                    <div class="hr-black"></div>
                    <div class="form-group col-md-4 content-style" ng-repeat="section in sections">
                        <div class="content-block" style="text-decoration: underline">
                            {{section.section_name}}
                        </div>
                        <div class="no-items content-block">
                            <div ng-show="noStuffsInSection(section)" ng-model="section.section_name">No checked items</div>
                        </div>
                        <div ng-repeat="stuffs in section.stuffs" ng-show="stuffs.selected" class="font-style">
                            <label style="cursor: pointer">
                                <input type="checkbox"
                                       ng-model="stuffs.selected"
                                       value="{{stuffs.stuff_name}}"
                                       ng-checked="checkedItems.indexOf(stuffs) != -1">
                                <span class="tab"></span>{{stuffs.stuff_name}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
