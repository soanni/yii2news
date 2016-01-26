<?php

use yii\grid\GridView;
use yii\helpers\Html;

echo Html::a('Create multiple customers', 'customers/create-multiple-models' , ['class' => 'btn btn-primary']);
echo '<br/><br/>';
echo Html::a('Create customer and reservation','reservations/create-customer-and-reservation',['class' => 'btn btn-primary']);
?>

<h2>Customers</h2>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'surname',
        'phone_number',
        [
            'class' => 'yii\grid\DataColumn',
            'header' => 'Reservations',
            'content' => function($model,$key,$index,$column){
                $title = sprintf('Reservations (%d)',$model->reservationsCount);
                return Html::a($title,['reservations/grid','Reservation[customer_id]' => $model->id]);
            }
        ],
        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'template' => '{delete}'
        ]
    ]
]);?>