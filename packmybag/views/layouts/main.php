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
<html lang="<?= Yii::$app->language ?>" ng-app="myApp" >
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://dl.dropboxusercontent.com/u/86701580/mypersonalcdn/renda/renda-icon-font.css">
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Lobster+Two:4000,7000italic' rel='stylesheet' type='text/css'>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.9/angular-animate.js"></script>
<script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-1.1.2.js"></script>

<script src="http://angular-ui.github.io/ui-router/release/angular-ui-router.js"></script>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
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


    <div class="wrap" ng-controller="LoginController">
            <div ng-controller="SignController">
            <?
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    Yii::$app->user->isGuest ?
                        [
                            'label' => ''
                        ] :
                        [ 'label' => 'Travel advices',
                            'url'=> 'http://www.skyscanner.net/news/50-insider-travel-tips-tricks-what-we-ve-learned-about-travelling',
                            'linkOptions' => array('data-method' => 'post', 'target' => '_blank'),

                        ],

                    Yii::$app->user->isGuest ?
                        [
                            'label' => 'Login',
                            'options'=> array('ng-click'=>'openLogin()')
                        ] :
                        ['label' => 'Logout(' . Yii::$app->user->identity->email .')',
                            'url'=> '/index.php?r=site/logout',
                            'linkOptions' => ['data-method' => 'post']
                            ],
                    Yii::$app->user->isGuest ?
                        [
                            'label' => 'Sign Up',
                            'options'=> array('ng-click'=>'userSign()')
                        ] :
                        ['label' => '']
                ],
            ]);?>
            </div>
        </div>
       <?php NavBar::end();
    ?>

    <div class="containerContent">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>

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


