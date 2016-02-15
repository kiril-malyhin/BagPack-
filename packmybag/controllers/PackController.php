<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


class PackController extends Controller{

    public function actionCreate(){
        return $this->render("index");
    }
    public function actionAdvice(){
        return $this->render("advice");
    }
}

