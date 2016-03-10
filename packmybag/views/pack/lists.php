<?php

$this->title = 'BagPack';
?>

<div class="profile-body" ng-controller="listCtrl" style="padding-top: 70px; padding-bottom: 100px;background-color: #fab136; height: 100%; min-height: 100%">
    <div class="container">
        <div class="row">
            <div class="name-style content-block center-block" style="color: darkblue">Lists</div>
            <div class="hr-contact"></div>
            <br>

            <div ng-if="!lists || lists.length < 1" style="text-align: center" class="no-lists">
                No lists found.
            </div>
            <div class="col-md-4" ng-repeat="list in lists">
                <div class="card card-inverse wish-item" style="background-color: darkblue; border-color: black;">
                    <div class="card-block">

                        <div style="display: inline">
                            <h2 class="card-title" data-toggle="tooltip" data-placement="top"  title="Click to open list">{{list.list_name}}
                                <div class="pull-right">
                                    <button class="btn btn-primary btn-xs"
                                            data-toggle="tooltip" data-placement="top"
                                            title="Edit"
                                            data-title="Edit">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>

                                    <button class="btn btn-danger btn-xs"
                                            data-title="Delete"
                                            data-placement="top"
                                             ng-click="deleteList(list.list_id)">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </button>
                                </div>
                            </h2>
                        </div>
                        <br>
                        <textarea class="description" disabled="disabled"  rows="3" >{{list.list_description}}</textarea>
                    </div>
                </div>
                <br>
            </div>

        </div>
    </div>
</div>
