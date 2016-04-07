<?php

$this->title = 'BagPack';
?>

<div class="profile-body list-style" ng-controller="listCtrl">
    <div class="container">
        <div class="row">
            <div class="name-style content-block center-block" style="color: white">Lists by {{userName[0].email}}</div>
            <div class="hr-contact"></div>
            <br>
            <div ng-if="!lists || lists.length < 1" style="text-align: center" class="no-lists">
                No lists found.
            </div>
            <div class="col-md-3 col-sm-12"  ng-repeat="list in lists">
                <div class="card card-inverse wish-item">
                    <div class="card-block">
                        <div style="display: inline">
                            <div class="content-block">
                                <p style="color: white; text-align: center; font-size: 50px" >{{list.list_name}}</p>
                                <h2 class="card-title">
                                    <button class="btn btn-default " style="color: white;background-color: transparent"
                                        data-placement="top"
                                        tooltip-placement="top-left"
                                        uib-tooltip="Open list"
                                        ng-click="packList(list.list_id)">Pack
                                    </button>
                                    <div class="pull-right">
                                        <button class="btn btn-primary btn-xs"
                                                data-placement="top"
                                                tooltip-placement="top" uib-tooltip="Edit"
                                                ng-click="editList(list.list_id)">
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
                        <label class="description-style">Description:</label>
                        <textarea class="description" disabled="disabled"  rows="3" >{{list.list_description}}</textarea>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
