<?php

namespace app\controllers;


use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Category;
use app\models\User;

use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class AuthController extends \yii\web\Controller
{


    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
            return $this->goBack();
        return $this->render('/auth/login', [
            'model' => $model,
        ]);
    }

    public function actionTest()
    {
        $user = User::findOne(1);

        //   Yii::$app->user->login($user);
        if (Yii::$app->user->isGuest) echo "Пользователь гость";
        else echo "Пользователь зарегистрирован";
        var_dump(Yii::$app->user);
        die;
    }
}
