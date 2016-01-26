<?php

namespace app\controllers;

use app\models\Customer;
use yii;
use yii\web\Controller;
use app\models\Reservation;
use app\models\ReservationSearch;
use app\models\Room;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;


class ReservationsController extends Controller{
    public function actionGrid(){
        $queryReservation = Reservation::find();
        $queryRoom = Room::find();
        $searchReservation = new ReservationSearch();
        $searchRoom = new Room();
        if(isset($_GET['ReservationSearch'])){
            $searchReservation->load(Yii::$app->request->get());
            $queryReservation->joinWith(['customer']);
            $queryReservation->andFilterWhere(['LIKE','customer.surname',$searchReservation->getAttribute('customer.surname')]);
            $queryReservation->andFilterWhere([
                'id' => $searchReservation->id,
                'room_id' => $searchReservation->room_id,
                'customer_id' => $searchReservation->customer_id,
                'price_per_day' => $searchReservation->price_per_day
            ]);
        }
        $avg = $queryReservation->average('price_per_day');

        if(isset($_GET['Room'])){
            $searchRoom->load(Yii::$app->request->get());
            $queryRoom->andFilterWhere([
                'id' => $searchRoom->id,
                'floor' => $searchRoom->floor,
                'room_number' => $searchRoom->room_number,
                'has_conditioner' => $searchRoom->has_conditioner,
                'has_tv' => $searchRoom->has_tv,
                'has_phone' => $searchRoom->has_phone,
                'available_from' => $searchRoom->available_from,
                'price_per_day' => $searchRoom->price_per_day,
                'description' => $searchRoom->description
            ]);
        }
        $dataReservation= new ActiveDataProvider([
            'query' => $queryReservation,
            'sort' => [
                'sortParam' => 'reservations_sort_param'
            ],
            'pagination' => [
                'pageSize' => 3,
                'pageParam' => 'reservations_page_param'
            ]
        ]);

        $dataRoom = new ActiveDataProvider([
            'query' => $queryRoom,
            'sort' => [
                'sortParam' => 'rooms_sort_param'
            ],
            'pagination' => [
                'pageSize' => 3,
                'pageParam' => 'rooms_sort_param'
            ]
        ]);

        return $this->render('grid',['dataReservation' => $dataReservation,
                                     'dataRoom' => $dataRoom,
                                     'searchReservation' => $searchReservation,
                                     'searchRoom' => $searchRoom,
                                     'averagePrice' => $avg]);
    }

    public function actionDetailDependentDropdown(){
        $showDetail = false;
        $model = new Reservation();
        if(isset($_POST['Reservation'])){
            $model->load(Yii::$app->request->post());
            if(isset($_POST['Reservation']['id']) && $_POST['Reservation']['id'] != null){
                $model = Reservation::findOne($_POST['Reservation']['id']);
                $showDetail = true;
            }

        }
        return $this->render('detailDependentDropdown',['model' => $model, 'showDetail' => $showDetail]);
    }

    public function actionAjaxDropdownListByCustomerId($customer_id){
        $output = '';
        $items = Reservation::findAll(['customer_id' => $customer_id]);
        foreach($items as $item){
            $content = sprintf('reservation #%s at %s',$item->id,date('Y-m-d H:i:s',strtotime($item->reservation_date)));
            $output .= Html::tag('option',$content,['value' => $item->id]);
        }
        return $output;
    }

    public function actionCreateCustomerAndReservation(){
        $customer = new Customer();
        $reservation = new Reservation();
        $reservation->customer_id = 1;
        if($customer->load(Yii::$app->request->post()) && $customer->validate()
            && $reservation->load(Yii::$app->request->post()) && $reservation->validate()){
            $dbTrans = Yii::$app->db->beginTransaction();
            $customerSaved = $customer->save();
            if($customerSaved){
                $reservation->customer_id = $customer->id;
                $reservationSaved = $reservation->save();
                if($reservationSaved){
                    $dbTrans->commit();
                    $this->redirect(['grid']);
                }else{
                    $dbTrans->rollBack();
                }
            }else{
                $dbTrans->rollBack();
            }
        }
        return $this->render('createCustomerAndReservation',compact('customer','reservation'));
    }
}