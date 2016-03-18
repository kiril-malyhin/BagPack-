<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\db\Query;


class PackController extends Controller{

    public function actionCreate(){
        return $this->render("index");
    }

    public function actionShowlists(){
        return $this->render("lists");
    }

    public function actionOpen_packing_list(){
        return $this->render('packingList');
    }

}

