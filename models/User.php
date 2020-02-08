<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;


class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ];
    }
    public static function findIdentity($id)
    {
        return User::findOne($id);
    }

    public function getId()
    {
        return $this->id;
    }
    public static function findIdentityByAccessToken($token, $type = null){

    }

    public function getAuthKey(){}

  
    public function validateAuthKey($authKey){

    }

    public static function findByName($name){
        return User::find()
        ->where(['name'=>$name])
        ->one();
    }

    public function validatePassword($password){
        return($this->password==$password)?true:false;
    }

}
