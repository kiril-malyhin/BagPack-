<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Query;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        $query= new Query();

        if ($this->validate()) {
            $userInfo = $query->select("email")->from('user')->where(['email'=>$this->username,'password'=>sha1($this->password)])->one();
            if(count($userInfo) == 1){
                return Yii::$app->user->login($this->getUser() , $this->rememberMe ? 3600*24*30 : 0);
            }else{
                return false;
            }
        }
    }

    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username, sha1($this->password));
        }

        return $this->_user;
    }
}
