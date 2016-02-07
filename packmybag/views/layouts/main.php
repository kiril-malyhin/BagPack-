<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Modal;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="myApp">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://dl.dropboxusercontent.com/u/86701580/mypersonalcdn/renda/renda-icon-font.css">
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Lobster+Two:4000,7000italic' rel='stylesheet' type='text/css'>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
        <?php
        NavBar::begin([
            'brandLabel' => 'BagPack',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        ?>
    <div class="wrap">
        <?
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                Html::button('Login <span class="glyphicon glyphicon-user"></span>' , [ 'class'=>'btn btn-my-login', 'style'=>'margin-top:
                8px', 'id'=>'modalLoginButton']),
                Html::button('Sign Up <i class="fa fa-user-plus"></i>', [ 'class'=>'btn btn-my-sign', 'style'=>'margin-top:
                8px', 'id'=>'modalSignUpButton']),
                Yii::$app->user->isGuest ?
                    ['label' => 'Login', 'url' => ['/site/login']] :
                    [
                        'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                        'url' => ['/site/logout'],
                        'linkOptions' => ['data-method' => 'post']
                    ],
            ],
        ]);?>
        </div>
       <?php NavBar::end();

    ?>

    <div class="containerContent">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>

    <?php
        Modal::begin([
            'header'=>'<h3>Login</h3>',
            'id'=>'modal-login',
            'size'=>'modal-md'

        ]);

        echo "<div id='modalLoginContent'>
            <div class=\"row\">
                <div class=\"col-xs-6\">
                    <div class=\"well\">
                        <form class=\"form-Login\" id=\"loginData\" ng-submit=\"login()\" novalidate>
                            <div class=\"form-group\">
                                <label for=\"email\"><span class=\"fa fa-user\"></span> Email</label>
                                <input type=\"email\" name=\"email\" class=\"form-control\" ng-model=\"loginData.email\" placeholder=\"Enter email\" id=\"email\" class=\"sr-only\" required autofocus>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"password\"><span class=\"fa fa-key\"></span> Password</label>
                                <input type=\"password\" name=\"password\" class=\"form-control\" ng-model=\"loginData.password\" id=\"password\" placeholder=\"Enter password\" class=\"sr-only\" required autofocus>
                            </div>
                                <span class=\"checkbox\">
                                    <label><input type=\"checkbox\" value=\"\" checked>Remember me</label>
                                    <br>
                                    </span>
                            <button type=\"submit\" class=\"btn btn-success btn-block\"><span class=\"fa fa-sign-in\"></span> Login</button>
                        </form>
                    </div>

                </div>
                <div class=\"col-xs-6\">
                    <p class=\"lead\">Register now for <span class=\"text-success\">FREE</span></p>
                    <ul class=\"list-unstyled\" style=\"line-height: 3\">
                        <li><span class=\"fa fa-check text-success\"></span> See all your orders</li>
                        <li><span class=\"fa fa-check text-success\"></span> Shipping is always free</li>
                        <li><span class=\"fa fa-check text-success\"></span> Save your favorites</li>
                        <li><span class=\"fa fa-check text-success\"></span> Fast checkout</li>
                    </ul>
                </div>
            </div>
        </div>";
        Modal::end();

        Modal::begin([
            'header'=>'<h3>Sign up</h3>',
            'id'=>'modal-sign',
            'size'=>'modal-md'

        ]);

        echo "<div id='modalSignUpContent'>

            <div class=\"row\">
                <div class=\"col-xs-6\">
                    <div class=\"well\">
                        <form id=\"signUpData\">
                            <div class=\"form-group\">
                                <label for=\"first-name\"><span class=\"fa fa-user\"></span>First name</label>
                                <input ng-model=\"registrationData.first_name\" type=\"text\" class=\"form-control\" placeholder=\"Enter first name\" id=\"first-name\" class=\"sr-only\" required autofocus>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"email\"><span class=\"fa fa-at\"></span> Email</label>
                                <input ng-model=\"registrationData.email\" type=\"email\" class=\"form-control\" placeholder=\"Enter email\" id=\"email\" class=\"sr-only\" required autofocus>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"password\"><span class=\"fa fa-key\"></span> Password</label>
                                <input ng-model=\"registrationData.password\" type=\"password\" class=\"form-control\" placeholder=\"Enter password\" id=\"password\" class=\"sr-only\" required autofocus>
                            </div>
                            <div class=\"form-group\">
                                <label for=\"confirm\"><span class=\"fa fa-key\"></span> Confirm password</label>
                                <input ng-model=\"registrationData.confirm\" type=\"password\" class=\"form-control\" placeholder=\"Confirm password\" id=\"confirm\" class=\"sr-only\" required autofocus>
                            </div>
                            <button type=\"submit\" class=\"btn btn-success btn-block\"><span class=\"fa fa-user-plus\"></span> Sign up now!</button>
                        </form>
                    </div>
                </div>

                <div class=\"col-xs-6\">
                    <p class=\"lead\">Register now for <span class=\"text-success\">FREE</span></p>
                    <ul class=\"list-unstyled\" style=\"line-height: 3\">
                        <li><span class=\"fa fa-check text-success\"></span> See all your orders</li>
                        <li><span class=\"fa fa-check text-success\"></span> Shipping is always free</li>
                        <li><span class=\"fa fa-check text-success\"></span> Save your favorites</li>
                        <li><span class=\"fa fa-check text-success\"></span> Fast checkout</li>
                        <li><span class=\"fa fa-check text-success\"></span> Get a gift <small>(only new customers)</small></li>
                        <li><span class=\"fa fa-check text-success\"></span>Holiday discounts up to 30% off</li>
                    </ul>
                </div>
            </div>
        </div>";
        Modal::end();
    ?>

    <footer class="footer">
        <div class="containerContent">
            <p class="pull-left">&copy; BagPack <?= date('Y') ?></p>

            <p class="pull-right">Made by Kirill Malyhin</p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
