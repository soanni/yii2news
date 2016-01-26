<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Room;
use app\models\Reservation;
use app\models\Customer;
use yii\web\UploadedFile;

class RoomsController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create','update'],
                        'roles' => ['admin']
                    ],
                ]
            ]
        ];
    }

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
        if($model->load(Yii::$app->request->post())){
            $image = UploadedFile::getInstance($model,'fileImage');
            if($image){
                $ext = $image->extension;
                $name = Yii::$app->security->generateRandomString(11);
                if($image->saveAs(Yii::getAlias('@uploadedFilesDir/' . $name . '.' . $ext))){
                    $model->fileImage = "$name.$ext";
                }
            }
            if($model->save()){
                $this->redirect(['rooms/index']);
            }
        }

        return $this->render('create',['model' => $model,'type' => 'Create']);
    }

    public function actionUpdate($room_id){
        $model = Room::findOne($room_id);
        if( ($model != null) && ($model->load(Yii::$app->request->post())) && ($model->save())){
            $this->redirect(['rooms/index']);
        }
        return $this->render('update',['model' => $model, 'type' => 'Update']);
    }

    public function actionView($room_id){
        $model = Room::findOne($room_id);
        return $this->render('view',['room' => $model]);
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
            $rooms = array($reservationSelected->room);
            $customers = array($reservationSelected->customer);
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
