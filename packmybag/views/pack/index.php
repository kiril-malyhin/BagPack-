<?php

/* @var $this yii\web\View */

$this->title = 'BagPack';
?>

<div class="pack-index" ng-controller="myBarCtrl">
    <div class="row" >
        <div class="col-md-3 bar-st" style="color: white" >

            <div class="choose-bar-block under-bar" >
                <div class="center-block"><h2>Choose your travel options</h2></div>
                <hr>
                <h4>Gender</h4>
                <div class="choose-group" id="choose-gender" data-toggle="buttons">
                    <label class="btn btn-default choose" ng-click="radioButtonSetValue(bar, 'gender', 'male')">
                        <input type="radio" ng-model="bar.gender" value="male">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Male</span>
                    </label>

                    <label class="btn btn-default choose" ng-click="radioButtonSetValue(bar, 'gender', 'female')">
                        <input type="radio" ng-model="bar.gender" value="female">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Female</span>
                    </label>
                </div>
                <hr>
                <h4>Temperature</h4>
                <div class="choose-group" id="choose-temperature" data-toggle="buttons">
                    <label class="btn btn-default choose" ng-click="radioButtonSetValue(bar, 'temperature', 'warm')">
                        <input type="radio" ng-model="bar.temperature" value="warm">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Warm</span>
                    </label>

                    <label class="btn btn-default choose" ng-click="radioButtonSetValue(bar, 'temperature', 'temperate')">
                    <input type="radio" ng-model="bar.temperature" value="temperate">
                    <span class="radio-dot"></span>
                    <span class="choose-word">Temperate</span>
                    </label>

                    <label class="btn btn-default choose bet-buttons" ng-click="radioButtonSetValue(bar, 'temperature', 'cold')">
                        <input type="radio" ng-model="bar.temperature" value="cold">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Cold</span>
                    </label>
                </div>
                <hr>
                <h4>Period</h4>
                <div class="choose-group" id="choose-period" data-toggle="buttons">
                    <label class="btn btn-default choose" ng-click="radioButtonSetValue(bar, 'period', '3 days')">
                        <input type="radio" ng-model="bar.period" value="3 days">
                        <span class="radio-dot"></span>
                        <span class="choose-word">3 days</span>
                    </label>

                    <label class="btn btn-default choose" ng-click="radioButtonSetValue(bar, 'period', '7 days')">
                        <input type="radio" ng-model="bar.period" value="7 days">
                        <span class="radio-dot"></span>
                        <span class="choose-word">7 days</span>
                    </label>

                    <label class="btn btn-default choose bet-buttons" ng-click="radioButtonSetValue(bar, 'period', '14 days')">
                        <input type="radio" ng-model="bar.period" value="14 days">
                        <span class="radio-dot"></span>
                        <span class="choose-word">14 days</span>
                    </label>

                    <label class="btn btn-default choose bet-buttons" ng-click="radioButtonSetValue(bar, 'period', 'month')">
                        <input type="radio" ng-model="bar.period" value="month">
                        <span class="radio-dot"></span>
                        <span class="choose-word">month</span>
                    </label>
                </div>
                <hr>
                <h4>Where are you going?</h4>
                <div class="choose-group" id="choose-aim" data-toggle="buttons">
                    <label class="btn btn-default choose" ng-click="radioButtonSetValue(bar, 'aim', 'active')">
                        <input type="radio" ng-model="bar.aim" value="active">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Active</span>
                    </label>

                    <label class="btn btn-default choose" ng-click="radioButtonSetValue(bar, 'aim', 'leisure')">
                        <input type="radio" ng-model="bar.aim" value="leisure">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Leisure</span>
                    </label>

                    <label class="btn btn-default choose bet-buttons" ng-click="radioButtonSetValue(bar, 'aim', 'cognitive')">
                        <input type="radio" ng-model="bar.aim" value="cognitive">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Cognitive</span>
                    </label>
                </div>
                <hr>
                <h4>Transport</h4>
                <div class="choose-group" id="choose-transport" data-toggle="buttons">

                    <label class="btn btn-default choose" ng-click="radioButtonSetValue(bar, 'transport', 'car')">
                        <input type="radio" ng-model="bar.transport" value="car">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Car</span>
                    </label>

                    <label class="btn btn-default choose" ng-click="radioButtonSetValue(bar, 'transport', 'plane')">
                        <input type="radio" ng-model="bar.transport" value="plane">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Plane</span>
                    </label>

                    <label class="btn btn-default choose bet-buttons" ng-click="radioButtonSetValue(bar, 'transport', 'ship')">
                        <input type="radio" ng-model="bar.transport" value="ship">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Ship</span>
                    </label>

                    <label class="btn btn-default choose bet-buttons" ng-click="radioButtonSetValue(bar, 'transport', 'train')">
                        <input type="radio" ng-model="bar.transport" value="train">
                        <span class="radio-dot"></span>
                        <span class="choose-word">Train</span>
                    </label>
                </div>
            </div >
        </div>

        <div class="col-md-9 ">
            <div ng-show="showStartContent" class="content-block center-block">
                <div class="name-style">Lets start packing</div>
                <div class="hr-black"></div>
                <p class="fig"><img src="css/3.jpg" width="900" height="700"></p>
            </div>

            <div ng-show="showChooseContent" >
                <div class="name-style content-block center-block">Packing list</div>
                <div class="hr-black"></div>
                <div class="form-group">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <fieldset>
                            <h2>Documents</h2>
                            <input type="checkbox" name="animal" value="Cat" />Cats <br />
                            <input type="checkbox" name="animal" value="Dog" />Dogs<br />
                            <input type="checkbox" name="animal" value="Bird" />Birds<br />
                            <input type="submit" value="Submit now" />
                        </fieldset>
                    </div>
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <fieldset>
                            <h2>Clothes</h2>
                            <input type="checkbox" name="animal" value="Cat" />Cats <br />
                            <input type="checkbox" name="animal" value="Dog" />Dogs<br />
                            <input type="checkbox" name="animal" value="Bird" />Birds<br />
                            <input type="submit" value="Submit now" />
                        </fieldset>
                        <button type="button" class="btn btn-my-sign pack-button" style="margin-top: 100px" ng-click="packState()" >Pack now!</button>
                    </div>
                    <div class="col-md-1"></div>
                </div>

            </div>

            <div ng-show="showListContent">

                <div class="row" style="position: relative">
                    <div class="name-style content-block center-block" style="padding-right: 100px">List</div>
                    <div class="btn-group" style="position: absolute;right: 80px;top: 30px;">
                        <button type="button" class="btn btn-my-sign pack-button dropdown-toggle" data-toggle="dropdown">Save<span class="caret"></span></button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">PDF  <span class="glyphicon glyphicon-floppy-disk"></span></a></li>
                            <li><a href="#">Print  <span class="glyphicon glyphicon-print"></span></a></li>
                            <li class="divider"></li>
                            <li><a href='index.php?r=site/userlogin'>Profile <span class="glyphicon glyphicon-user"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="hr-black"></div>
            </div>
        </div>
    </div>
</div>
