<?php

$this->title = 'BagPack';
?>

<div class="pack-index" ng-controller="editCtrl">
    <div class="row" style=" cursor: pointer" >
        <div class="col-md-2 bar-st clearfix" style="color: white" >
            <div class="choose-bar-block" >
                <div class="center-block animated pulse infinite" style="margin-top: 48px">
                    <h2>Selected filters</h2>
                </div>
                <hr>
                <div ng-repeat="category in categories">
                    <h4>{{category.cat_filter_name}}</h4>
                    <div>
                        <div class="btn-group" id="{{category.cat_filter_id}}" data-toggle="buttons" >
                            <label ng-repeat="filters in category.filters" style="border-radius:20px;" class="btn btn-default choose filter-button"
                                   ng-click="radioButtonSetValue(category.cat_filter_id, filters.filter_id)" ng-class="{active: checked[filters.filter_id]}">
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
            <div ng-show="showEditContent" class="show-final-list-content  animated fadeInRight" >
                <div style="position: relative">
                    <div class="name-style content-block center-block label-pos-list" >
                        <i class="fa fa-arrow-left arrow-pos" data-placement="top" tooltip-placement="right-bottom"
                           uib-tooltip="Back to lists" ng-click="backToLists()">
                        </i>Edit list: <span ng-repeat="list in finalLists">{{list.list_name}}</span>
                        <i class="fa fa-refresh refresh-pos" ng-click="refreshPackingFinalList()"
                           tooltip-placement="bottom-left" uib-tooltip="Click to refresh list of stuffs">
                        </i>
                    </div>
                    <div class="btn-group btn-state">
                        <button type="button" class="btn btn-edit" data-toggle="dropdown">Save<span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a ng-click="openUpdate(finalLists[0])" >Update list  <span class="glyphicon glyphicon-refresh"></span></a></li>
                            <li><a ng-click="openList()"  >Create new list  <span class="glyphicon glyphicon-list"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="hr-black"></div>
                <div ng-show="startEditStuffs">
<!--                    <div class="form-group col-md-4 content-style"  ng-repeat="section in resultStuffs" >-->
<!--                        <div class="content-block" ng-hide="isSectionHidden(section)" style="text-decoration: underline">-->
<!--                            {{section.section_name}}-->
<!--                            <i style="color: #b50006" class="fa fa-plus-circle" ng-click="openNewStuff(section, checkedItems)"-->
<!--                               tooltip-placement=top}" uib-tooltip="Click to add new stuff">-->
<!--                            </i>-->
<!--                        </div>-->
<!--                        <div class="no-items content-block">-->
<!--                            <div ng-if="sectionsContent[section.section_id]" ng-model="section.section_name">No items</div>-->
<!--                        </div>-->
<!---->
<!--                        <div ng-repeat="stuffs in section.stuffs" class="font-style">-->
<!--                            <label style="cursor: pointer">-->
<!--                                <input type="checkbox"-->
<!--                                       ng-model="stuffs.selected"-->
<!--                                       ng-click="selectStuffFinalList(stuffs, section.section_name)"-->
<!--                                       value="{{stuffs.stuff_name}}"-->
<!--                                       ng-checked="isChecked(stuffs.stuff_id)">-->
<!--                            </label>-->
<!--                            <span class="tab"></span>-->
<!---->
<!--                            {{stuffs.stuff_name}}-->
<!--                        </div>-->
<!--                    </div>-->
                    <div class="form-group col-md-4 content-style" ng-if="section.section_name.length > 0"  ng-repeat="section in sections" >
                        <div class="content-block" ng-hide="isSectionHidden(section)" style="text-decoration: underline">
                            {{section.section_name}}
                            <i style="color: #b50006" class="fa fa-plus-circle" ng-click="openNewStuff(section, checkedItems)"
                               tooltip-placement=top}" uib-tooltip="Click to add new stuff">
                            </i>
                        </div>
                        <div class="no-items content-block">
                            <div ng-if="sectionsContent[section.section_id]" ng-model="section.section_name">No items</div>
                        </div>

                        <div ng-repeat="stuffs in section.stuffs" class="font-style">
                            <label style="cursor: pointer">
                                <input type="checkbox"
                                       ng-model="stuffs.selected"
                                       ng-click="selectStuffFinalList(stuffs, section.section_name)"
                                       value="{{stuffs.stuff_name}}"
                                       ng-checked="isChecked(stuffs.stuff_id)">
                            </label>
                            <span class="tab"></span>
                            {{stuffs.stuff_name}}
                        </div>
                    </div>
                </div>

                <div ng-show="filteringEditStuffs">
                    <div class="form-group col-md-4 content-style" ng-if="section.section_name.length > 0" ng-repeat="section in sections" >
                        <div ng-hide="section.section_name == 'Active' || section.section_name == 'Leisure' || section.section_name == 'Cognitive'"></div>
                        <div class="content-block" ng-hide="isSectionHidden(section)" style="text-decoration: underline">
                            {{section.section_name}}
                            <i style="color: #b50006" class="fa fa-plus-circle" ng-click="openNewStuff()"
                               tooltip-placement=top}" uib-tooltip="Click to add new stuff">
                            </i>
                        </div>
                        <div class="no-items">
                            <div ng-if="isSectionEmpty(section)" class="font-style" ng-model="section.section_name">No items</div>
                        </div>

                        <div ng-repeat="stuffs in section.stuffs"  class="font-style" ng-show="checkItem(stuffs)">
                            <label style="cursor: pointer">
                                <input type="checkbox"
                                       ng-model="stuffs.selected"
                                       ng-click="selectStuffFinalList(stuffs, section.section_name)"
                                       value="{{stuffs.stuff_name}}"
                                       ng-checked="isChecked(stuffs.stuff_id)">
                            <span class="tab"></span>{{stuffs.stuff_name}}
                            </label>
<!--                            <div class="no-items">-->
<!--                                <div ng-if="section.stuffs.length == 0" ng-model="section.section_name">No items</div>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
