<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller{
    public function beforeAction($action)
    {
        Yii::$app->language = 'ru';
        return parent::beforeAction($action);
    }
}