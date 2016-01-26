<?php

namespace app\models;

use app\models\Reservation;

class ReservationSearch extends Reservation{
    public function rules(){
        return array_merge(parent::rules(),[['customer.surname','safe']]);
    }

    public function attributes(){
        return array_merge(parent::attributes(),['customer.surname']);
    }
}