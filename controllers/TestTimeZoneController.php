<?php

namespace app\controllers;

use Faker\Provider\tr_TR\DateTime;
use Yii;
use yii\web\Controller;

class TestTimeZoneController extends Controller{
    public function actionCheck(){
        $dt = new \DateTime();
        echo 'Current date/time: ' . $dt->format('Y-m-d H:i:s');
        echo '<br/>';
        echo 'Current timezone: ' . $dt->getTimezone()->getName();
        echo '<br/>';
    }

    public function actionCheckDatabase(){
        $result = Yii::$app->db->createCommand('SELECT NOW()')->queryColumn();
        echo 'Current database time: ' . $result[0];
    }
}