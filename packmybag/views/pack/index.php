<?php

/* @var $this yii\web\View */

$this->title = 'BagPack';
?>

<div class="pack-index" ng-controller="myBarCtrl">
    <div class="row" >
        <div class="col-md-2 bar-st clearfix" style="color: white" >
            <div class="choose-bar-block" >
                <div class="center-block"><h2>Choose your travel options</h2></div>
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
            <div ng-show="showStartContent" class="content-block center-block">
                <div class="name-style">Lets start packing</div>
                <div class="hr-black"></div>
                <p class="fig"><img src="css/3.jpg" width="900" height="700"></p>
            </div>

            <div ng-show="showChooseContent" class="show-choose-content clearfix animated fadeInRightBig">
                <div class="row" style="position: relative">
                    <div class="name-style content-block center-block" style="padding-right: 100px">Packing list</div>
                    <div class="btn-group" style="position: absolute;right: 80px;top: 30px;">
                        <button type="button" class="btn btn-my-sign pack-button" ng-click="packState()">Pack now</button>
                    </div>
                </div>
                <div class="hr-black"></div>
                <div class="form-group col-md-4" ng-repeat="section in sections">
                    <div class="content-block">
                        {{section.section_name}}
                    </div>
                    <div ng-repeat="stuffs in section.stuffs">

                        <input type="checkbox" >{{stuffs.stuff_name}}
                    </div>
                </div>
            </div>

            <div ng-show="showListContent" class="show-list-content clearfix">

                <div class="row" style="position: relative">
                    <div class="name-style content-block center-block" style="padding-right: 100px">List</div>
                    <div class="btn-group" style="position: absolute;right: 80px;top: 30px;">
                        <button type="button" class="btn btn-my-sign pack-button dropdown-toggle" data-toggle="dropdown">Save<span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">PDF  <span class="glyphicon glyphicon-floppy-disk"></span></a></li>
                            <li><a href="#">Print  <span class="glyphicon glyphicon-print"></span></a></li>
                            <li class="divider"></li>
                            <li><a href='index.php?r=pack/lists'>List <span class="glyphicon glyphicon-list"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="hr-black"></div>

                <div class="form-group col-md-4" ng-repeat="section in sections">
                    <div >
                        <div class="content-block">
                            {{section.section_name}}
                            <i class="fa fa-plus-circle" data-toggle="tooltip" data-placement="top" title="Click to add new stuff"></i>
                        </div>
                        <div class="squaredTwo" ng-repeat="stuffs in section.stuffs">
                            <input type="checkbox" id="squaredTwo">{{stuffs.stuff_name}}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
