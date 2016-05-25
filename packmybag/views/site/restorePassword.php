<?php

/* @var $this yii\web\View */

$this->title = 'BagPack';
?>
<div ng-show="restorePage" ng-controller="passwordCtrl">
    <div class="restore-account" >
    <div class="text-center" style="padding:110px">
        <div class="logo">Restore password</div>
        <div class="login-form-1">
            <form id="restoreForm" method="POST" name="restoreForm" novalidate>
                <div class="login-group">
                    <div class="form-group">
                        <label class="sr-only control-label" name="password">Enter new password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter new password"
                               ng-model="restoreInfo.password" ng-minlength="4" ng-maxlength="32" required>
                        <p ng-show="restoreForm.password.$error.minlength" class="help-block">Password is too short.</p>
                        <p ng-show="restoreForm.password.$error.maxlength" class="help-block">Password is too long.</p>
                        <span class="help-block"></span>
                    </div>
                    <div class="form-group">
                        <label class="sr-only">Confirm password</label>
                        <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm password"
                               ng-model="restoreInfo.confirmPassword" ng-minlength="4" ng-maxlength="32" required>
                        <div class="style-password">
                            <p ng-show="(restoreInfo.password != restoreInfo.confirmPassword)" >Passwords do not match </p>
                        </div>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div style="padding-top: 5px"></div>
                <button ng-click="saveNewPassword()" ng-disabled="restoreForm.$invalid" class="btn btn-success pull-right">Save</button>
            </form>
        </div>
    </div>


</div>
</div>