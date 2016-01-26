<?php

namespace app\controllers;

use app\models\Reservation;
use yii\web\Controller;
use Yii;


class JuiWidgetsController extends Controller
{
    public function actionDatePicker(){
        $reservationUpdated = false;
        $model = Reservation::findOne(1);
        if(isset($_POST['Reservation'])){
            $model->load(Yii::$app->request->post());
            $model->date_from = Yii::$app->formatter->asDate(date_create_from_format('d/m/y',$model->date_from),'php:Y-m-d');
            $model->date_to = Yii::$app->formatter->asDate(date_create_from_format('d/m/y',$model->date_to),'php:Y-m-d');
            $reservationUpdated = $model->save();
        }
        return $this->render('datePicker',compact('model','reservationUpdated'));
    }
}