<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;


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

    public function actionEdit_list(){
        return $this->render('editList');
    }

}

