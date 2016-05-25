<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use app\models\LoginForm;


class LoginController extends BaseController
{
    public function actionLogin(){

        $model = new LoginForm();
        $model->password=Yii::$app->request->post('password');
        $model->username=Yii::$app->request->post('username');
        if ($model->login()) {
            return "true";
        }
        else{
            return "false";
        }

    }

    public function actionRestore_password(){

        $email_address = Yii::$app->request->post('restore_password');
        $myemail = $email_address;

        $query= new Query();
        if($userInfo = $query->from('user')->where(['user_email'=>$email_address])->exists())
        {
            $name = $query->select(['email'])->from('user')->where(['user_email'=>$email_address])->scalar();

            $to = $myemail;

            $subject = "Restore mail. Please, don't answer this message.";

            $message = "You have received a new message.".

                " Visit this page to restore your account:\n http://packbag.esy.es/packmybag/web/index.php?r=site/restore&name=".$name;

            $headers = "From: $myemail\n";

            mail($to,$subject,$message,$headers);

            echo json_encode(1);
        }
        else{
            echo json_encode(0);
        }



    }
}
