<?php
    use yii\grid\GridView;
    use yii\helpers\Html;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url;
    use app\models\Room;
    use app\models\Customer;
    use app\components\GridViewReservation;

    $filterRoom = ArrayHelper::map(Room::find()->all(),'id',function($model){
        return sprintf('Floor: %d - Number: %d',$model->floor,$model->room_number);
    });

//    $sum = 0;
//    $avg = 0;
//    if(count($data->getModels()) > 0){
//        foreach($data->getModels() as $m){
//            $sum += $m->price_per_day;
//        }
//        $avg = $sum/sizeof($data->getModels());
//    }

//    $filterCustomer = ArrayHelper::map(Customer::find()->all(),'id',function($model){
//        $name = $model->name;
//        $surname = $model->surname;
//        return "$name $surname";
//    });
?>
<?php echo Html::a('Detail dependent dropdown(AJAX)',Url::to(['reservations/detail-dependent-dropdown']),['class' => 'btn btn-primary']);?>
<h2>Reservations</h2>
<?= GridViewReservation::widget([
    'dataProvider' => $dataReservation,
    'filterModel' => $searchReservation,
    'showFooter' => true,
    'columns' => [
        [
            'header' => 'Room',
            'filter' => Html::activeDropDownList($searchReservation,'room_id',$filterRoom,['prompt' => '--All--']),
//            'content' => function($model){
//                return $model->room->room_number;
//            }
            'attribute' => 'room.room_number'
        ],
        [
            'header' => 'Customer',
            //'filter' => Html::activeDropDownList($search,'customer_id', $filterCustomer,['prompt' => '--All--']),
//            'content' => function($model){
//                $name = $model->customer->name;
//                $surname = $model->customer->surname;
//                return "$name&nbsp$surname";
//            }
            'attribute' => 'customer.surname'
        ],
        'price_per_day' => [
            'attribute' => 'price_per_day',
            'header' => 'Daily price',
            //'footer' => Yii::$app->formatter->asCurrency($averagePrice,'EUR')
            'footer' => sprintf('Average: %0.1f',$averagePrice)
        ],
        'date_from',
        'date_to',
        'reservation_date'
    ]
]);
?>
<h2>Rooms</h2>
<?= GridView::widget([
    'dataProvider' => $dataRoom,
    'filterModel' => $searchRoom,
    'columns' => [
        'id',
        'floor',
        'room_number',
        'has_conditioner:boolean',
        'has_tv:boolean',
        'has_phone:boolean',
        'available_from',
        'price_per_day',
        'description'
    ]
])
?>
