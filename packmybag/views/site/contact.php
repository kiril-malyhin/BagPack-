<?php

/* @var $this yii\web\View */

$this->title = 'BagPack';
?>

<div ng-controller="contactCtrl"  style="padding-top: 60px;">
    <div style="background-color: #562831">
        <div class="container contact-index">
            <div class="row">
                <div >
                    <div class="contact-form">
                        <form id="contactForm" method="POST" name="contactForm" novalidate>
                            <div class="row" style="position: relative;color: white">
                                <div class="name-style content-block center-block" style="padding-top: 20px">Contacts</div>
                            </div>

                            <div class="hr-contact" ></div>

                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="first_name" placeholder="Enter name" ng-minlength="6"
                                           ng-maxlength="32" ng-model="contactInfo.first_name" required>
                                </div>
                                <p ng-show="contactForm.first_name.$error.minlength" class="help-block" style="color: white">Name is too short.</p>
                                <p ng-show="contactForm.first_name.$error.maxlength" class="help-block" style="color: white">Name is too long.</p>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-building"></i></span>
                                    <input type="text" class="form-control" name="company" placeholder="Company" aria-describedby="basic-addon2"
                                           ng-minlength="3" ng-maxlength="64" ng-model="contactInfo.company" required>
                                </div>
                                <p ng-show="contactForm.company.$error.minlength" class="help-block" style="color: white">Company name is too short.</p>
                                <p ng-show="contactForm.company.$error.maxlength" class="help-block" style="color: white">Company name is too long.</p>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="basic-addon2">@</span>
                                    <input type="email" class="form-control" name="email" placeholder="Email" aria-describedby="basic-addon2"
                                           ng-email="4" ng-model="contactInfo.email" required>
                                </div>
                                <p ng-show="contactForm.email.$error.email" class="help-block" style="color: white">Format: example@example.com</p>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-phone"></i></span>
                                    <input type="number" class="form-control" name="phone" ng-model="contactInfo.phone"
                                           placeholder="Phone" aria-describedby="basic-addon2" required>
                                </div>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                             <textarea name="comments" class="form-control" ng-model="contactInfo.comments"
                                       placeholder="Message text" style="font-size: 18px"
                                       rows="6"
                                       ng-minlength="5" ng-maxlength="1024" required>
                            </textarea>
                                <span class="help-block"></span>
                            </div>
                            <button type="button" class="btn pull-right btn-default"  style="background-color: transparent; color: white"  ng-disabled="contactForm.$invalid" ng-click="contactUs()"> Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
    <div class="hr-divider-grey"></div>

    <div class="row">
        <div class="visit-index-start center-block" style="background-color: #333">
            <div class="center-block contact-start" style="color: white">

                <div class="row">

                    <div style="font-size: 60px">
                        Visit us at
                    </div>
                    <div class="hr-about"></div>
                    <br>
                    <div class="postal-address">
                        <span class="address-label-start">Address:</span>
                        <span class="address-info-start">Platonova 39, Minsk, Belarus</span>
                    </div>
                    <div>
                        <span class="address-label-start">
                           Phone:
                        </span>
                        <span class="address-info-start">
                            +375 17 221 46 51
                        </span>
                    </div>
                    <div>
                        <span class="address-label-start">
                           Email:
                        </span>
                        <span class="address-info-start">
                            usb.bsuir@gmail.com
                        </span>
                    </div>

                    <br>
                    <a href="http://facebook.com" target="_blank" class="btn btn-social-icon btn-facebook">
                        <i class="fa fa-facebook"></i></a>
                    <a href="http://vk.com" target="_blank" class="btn btn-social-icon btn-vk"><i class="fa fa-vk"></i></a>
                    <a href="http://plus.google.com" target="_blank" class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>
                    <a href="http://instagram.com" target="_blank" class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                    <a href="http://linkedin.com" target="_blank" class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                    <a href="http://twitter.com" target="_blank" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
                </div>


            </div>
        </div>
    </div>

</div>


