<?php

$this->title = 'BagPack';
?>

<div class="profile-body" ng-controller="listCtrl" style="padding-top: 70px; padding-bottom: 100px;background-color: #110433;min-height: 100%">
    <div class="container">
        <div class="row">
            <div class="name-style content-block center-block" style="color: white">Lists</div>
            <div class="hr-contact"></div>
            <br>

            <div ng-if="!lists || lists.length < 1" style="text-align: center" class="no-lists">
                No lists found.
            </div>
            <div class="col-md-3"  ng-repeat="list in lists">
                <div class="card card-inverse wish-item"  style="background-color: #165475; border-color: black;">
                    <div class="card-block">
                        <div style="display: inline">
                            <div class="content-block">
                                <h1 style="color: white; text-align: center">{{list.list_name}}</h1>
                                <h2 class="card-title">
                                    <button class="btn btn-default " style=";color: white;background-color: transparent"
                                        data-placement="top"
                                        tooltip-placement="top-left"
                                        uib-tooltip="Open list"
                                        ng-click="packList(list.list_id)">Pack
                                    </button>
                                    <div class="pull-right">
                                        <button class="btn btn-primary btn-xs"
                                                data-placement="top"
                                                tooltip-placement="top" uib-tooltip="Edit"
                                                ng-click="">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>

                                        <button class="btn btn-danger btn-xs"
                                                data-placement="top"
                                                tooltip-placement="top" uib-tooltip="Delete"
                                                 ng-click="deleteList(list.list_id)">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </div>
                                </h2>
                            </div>
                            <div class="card-img" alt="Card image">
                        </div>
                        <label style="color: white;font-family: 'Lobster Two', cursive;font-size: 20px;">Description:</label>
                        <textarea class="description" disabled="disabled"  rows="3" >{{list.list_description}}</textarea>
                    </div>
                </div>
                <br>
            </div>
                <div style="padding-bottom: 25px"></div>
        </div>

    </div>
</div>
