<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'js/libs/ng-alertify/dist/ng-alertify.css',
        'js/libs/font-awesome-4.5.0/css/font-awesome.min.css',
        'css/site.css',
        'css/animate.css',
        'css/icons.css'
    ];
    public $js = [
        'js/libs/ng-alertify/dist/ng-alertify.js',
        'js/myApp.js',
        'js/site/myBarCtrl.js',
        'js/site/listCtrl.js',
        'js/site/contactCtrl.js',
        'js/site/editCtrl.js',
        'js/site/paymentCtrl.js',
        'js/user/loginCtrl.js',
        'js/user/signCtrl.js',
        'js/user/passwordCtrl.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
