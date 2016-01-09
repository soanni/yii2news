<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Room;
use app\models\Reservation;
use app\models\Customer;
use yii\web\UploadedFile;

class RoomsController extends Controller{

    public function actionIndex(){
        $sql = 'SELECT * from room ORDER BY id ASC';
        $rooms = Yii::$app->db->createCommand($sql)->queryAll();
        return $this->render('index',['rooms' => $rooms]);
    }

    public function actionIndexFiltered(){
        $query = Room::find();
        $searchFilter = [
            'floor' => ['operator'=> '', 'value' => ''],
            'room_number' => ['operator'=> '', 'value' => ''],
            'price_per_day' => ['operator'=> '', 'value' => '']
        ];

        if(isset($_POST['SearchFilter'])){
            $fieldsList = ['floor','room_number','price_per_day'];
            foreach($fieldsList as $field){
                $fieldOperator = $_POST['SearchFilter'][$field]['operator'];
                $value = $_POST['SearchFilter'][$field]['value'];
                $searchFilter[$field] = ['operator' => $fieldOperator, 'value' => $value];
                if($value != ''){
                    $query->andWhere([$fieldOperator,$field,$value]);
                }
            }
        }
        $rooms = $query->all();
        return $this->render('indexFiltered',['rooms' => $rooms, 'searchFilter' => $searchFilter]);
    }

    public function actionCreate(){
        $model = new Room();
        $modelCanSave = false;

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->fileImage = UploadedFile::getInstance($model,'fileImage');
            if($model->fileImage){
                $model->fileImage->saveAs(Yii::getAlias('@uploadedFilesDir/' . $model->fileImage->baseName . '.' . $model->fileImage->extension));
            }
            $modelCanSave = true;
        }

        return $this->render('create',['model' => $model, 'modelSaved' => $modelCanSave]);
    }

    public function actionLastReservationByRoomId($room_id){
        $room = Room::findOne($room_id);
        $lastReservation = $room->lastReservation;
        return $this->render('lastReservationByRoomId',['room' => $room, 'lastReservation' => $lastReservation]);
    }

    public function actionLastReservationForEveryRoom(){
        $rooms = Room::find()->with('lastReservation')->all();
        return $this->render('lastReservationForEveryRoom',['rooms' => $rooms]);
    }

    public function actionIndexWithRelations(){
        $roomid = Yii::$app->request->get('room_id',null);
        $reservationid = Yii::$app->request->get('reservation_id',null);
        $customerid = Yii::$app->request->get('customer_id',null);
        $roomSelected = null;
        $reservationSelected = null;
        $customerSelected = null;
        if($roomid != null){
            $roomSelected = Room::findOne($roomid);
            $rooms = array($roomSelected);
            $reservations = $roomSelected->reservations;
            $customers = $roomSelected->customers;
        }elseif($reservationid != null){
            $reservationSelected = Reservation::findOne($reservationid);
            $reservations = array($reservationSelected);
            $rooms = $reservationSelected->room;
            $customers = $reservationSelected->customer;
        }elseif($customerid != null){
            $customerSelected = Customer::findOne($customerid);
            $customers = array($customerSelected);
            $rooms = $customerSelected->rooms;
            $reservations = $customerSelected->reservations;
        }else{
            $rooms = Room::find()->all();
            $reservations = Reservation::find()->all();
            $customers = Customer::find()->all();
        }

        return $this->render('indexWithRelations',['roomSelected' => $roomSelected
                                                    ,'reservationSelected' => $reservationSelected
                                                    ,'customerSelected' => $customerSelected
                                                    ,'rooms' => $rooms
                                                    ,'customers' => $customers
                                                    ,'reservations' => $reservations]);
    }
}
