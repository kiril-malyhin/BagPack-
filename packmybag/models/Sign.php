<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\Model;

class SignForm extends Model
{
    public $email;

    public function rules()
    {
        /*return [
        ['email', 'required'],
        ['email', 'email'],
        ['password', 'required'],
        ];*/
    }
}
class Sign extends ActiveRecord
{

}