<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\models\Customer;


class CustomersController extends Controller{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className()
            ]
        ];
    }

    public function actionGrid(){
        $query = Customer::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);
        return $this->render('grid',['dataProvider' => $dataProvider]);
    }

    public function actionCreateMultipleModels(){
        $models = [];
        $OK = true;
        if(isset($_POST['Customer'])){
            foreach($_POST['Customer'] as $postObj){
                $customer = new Customer();
                $customer->attributes = $postObj;
                $isValid = $customer->validate();
                $OK = $OK && $isValid;
                $models[] = $customer;
            }
            if($OK){
                foreach($models as $model){
                    $model->save();
                }
                $this->redirect('customers/grid');
            }
        }else{
            for($i = 0; $i < 3; $i++){
                $models[] = new Customer();
            }
        }
        return $this->render('createMultipleModels',compact('models'));
    }
}