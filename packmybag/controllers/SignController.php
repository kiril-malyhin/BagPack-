<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\db\ActiveRecord;


class SignController extends BaseController
{
    public function actionSign(){

        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $user_email = Yii::$app->request->post('user_email');

        $query= new Query();
        if($userInfo = $query->from('user')->where(['email'=>$username, 'user_email'=> $user_email])->exists()
            || $username == ""
            || $password ==""
            || $user_email==""
            || strlen($user_email) < 4
            || strlen($password) < 4
            || strlen($username) < 6
        )
        {
            echo json_encode('bad');
        }
        else{
            $authKey = $username . " | " . uniqid() . uniqid() . uniqid();
            Yii::$app->db->createCommand()
                ->insert('user',
                    ['email'=>$username,'password'=>sha1($password), 'user_email'=> $user_email, 'authKey'=> $authKey])
                ->execute();
            echo json_encode('ok');
        }
    }
}

//class Country extends ActiveRecord{
//
//}



