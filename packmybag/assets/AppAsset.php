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
        'css/site.css'
    ];
    public $js = [
        'js/libs/ng-alertify/dist/ng-alertify.js',
        'js/radioButton.js',
        'js/myApp.js',
        'js/myBarCtrl.js',
        'js/angularModal.js'

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
