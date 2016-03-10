<?php

/* @var $this yii\web\View */

$this->title = 'BagPack';
?>

<div ng-controller="contactCtrl"  style="padding-top: 60px;">
    <div style="background-color: #fab136">
        <div class="container contact-index">
            <div class="row">
                <div >
                    <div class="contact-form">
                        <form id="contactForm" method="POST" name="contactForm" novalidate>
                            <div class="row" style="position: relative;color: darkblue">
                                <div class="name-style content-block center-block" style="padding-top: 20px">Contacts</div>
                            </div>

                            <div class="hr-contact" ></div>

                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control" name="first_name" placeholder="Enter name" ng-minlength="6"
                                           ng-maxlength="32" ng-model="contactInfo.first_name" required>
                                </div>
                                <p ng-show="contactForm.first_name.$error.minlength" class="help-block">Name is too short.</p>
                                <p ng-show="contactForm.first_name.$error.maxlength" class="help-block">Name is too long.</p>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="basic-addon2"><i class="fa fa-building"></i></span>
                                    <input type="text" class="form-control" name="company" placeholder="Company" aria-describedby="basic-addon2"
                                           ng-minlength="3" ng-maxlength="64" ng-model="contactInfo.company" required>
                                </div>
                                <p ng-show="contactForm.company.$error.minlength" class="help-block">Company name is too short.</p>
                                <p ng-show="contactForm.company.$error.maxlength" class="help-block">Company name is too long.</p>
                                <span class="help-block"></span>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon" id="basic-addon2">@</span>
                                    <input type="email" class="form-control" name="email" placeholder="Email" aria-describedby="basic-addon2"
                                           ng-email="4" ng-model="contactInfo.email" required>
                                </div>
                                <p ng-show="contactForm.email.$error.email" class="help-block">Format: example@example.com</p>
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
                            <button type="button" class="btn pull-right btn-submit" ng-disabled="contactForm.$invalid" ng-click="contactUs()"> Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
    <div class="hr-divider"></div>

    <div class="row">
        <div class="visit-index center-block">
            <div class="row hr-visit-content" style="position: relative; padding-bottom: 50px; font-size: 50px;color: darkblue">
                Visit us at
                <div class="hr-visit "></div>
            </div>

            <div class="col-md-6">
                <div class="address-info-container">
                    <div class="postal-address">
                        <span class="address-label">Address:</span>
                        <span class="address-info">Platonova 39, Minsk, Belarus</span>
                    </div>
                    <div>
                    <span class="address-label">
                       Phone:
                    </span>
                    <span class="address-info">
                        +375 17 221 46 51
                    </span>
                    </div>
                    <div>
                    <span class="address-label">
                       Email:
                    </span>
                    <span class="address-info">
                        usb.bsuir@gmail.com
                    </span>
                    </div>
                    <br><br>
                    <a href="http://facebook.com" target="_blank" class="btn btn-social-icon btn-facebook">
                        <i class="fa fa-facebook"></i></a>
                    <a href="http://vk.com" target="_blank" class="btn btn-social-icon btn-vk"><i class="fa fa-vk"></i></a>
                    <a href="http://plus.google.com" target="_blank" class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus"></i></a>
                    <a href="http://instagram.com" target="_blank" class="btn btn-social-icon btn-instagram"><i class="fa fa-instagram"></i></a>
                    <a href="http://linkedin.com" target="_blank" class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
                    <a href="http://twitter.com" target="_blank" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>

                </div>

            </div>

            <div class="col-md-6">
                <div id="map"></div>
                <script>
                    function initMap() {
                        var mapDiv = document.getElementById('map');
                        var map = new google.maps.Map(mapDiv, {
                            center: {lat: 53.911749, lng: 27.595683},
                            zoom: 10
                        });
                    }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
                        async defer></script>
            </div>
        </div>
    </div>

</div>


