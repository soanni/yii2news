<?php


namespace app\controllers;
use yii\web\Controller;
use Yii;


class MyAuthenticationController extends Controller
{
    public function actionInitializeAuthorizations(){
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $permCreateReservation = $auth->createPermission('createReservation');
        $permCreateReservation->description = 'Permission to create a reservation';
        $auth->add($permCreateReservation);

        $permUpdateReservation = $auth->createPermission('updateReservation');
        $permUpdateReservation->description = 'Permission to update a reservation';
        $auth->add($permUpdateReservation);

        $roleOperator = $auth->createRole('operator');
        $auth->add($roleOperator);
        $auth->addChild($roleOperator,$permCreateReservation);

        $roleAdmin = $auth->createRole('admin');
        $auth->add($roleAdmin);
        $auth->addChild($roleAdmin,$roleOperator);
        $auth->addChild($roleAdmin,$permUpdateReservation);

        $auth->assign($roleAdmin,1);
        $auth->assign($roleOperator,2);
    }
}