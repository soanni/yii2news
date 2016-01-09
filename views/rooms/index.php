<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    $this->params['breadcrumbs'][] = 'Rooms list';
    echo Html::a('Room create',Url::to(['rooms/create']),['class' => 'btn btn-primary']);
    echo '<br/><br/>';
    echo Html::a('Filtered list of rooms',Url::to(['rooms/index-filtered']),['class' => 'btn btn-primary']);
    echo '<br/><br/>';
    echo Html::a('Last reservation for every room',Url::to(['rooms/last-reservation-for-every-room']),['class' => 'btn btn-primary']);
    echo '<br/><br/>';
    echo Html::a('Index with relations',Url::to(['rooms/index-with-relations']),['class' => 'btn btn-primary']);
?>

<table class="table">
    <tr>
        <th>Floor</th>
        <th>Room number</th>
        <th>Has conditioner</th>
        <th>Has TV</th>
        <th>Has phone</th>
        <th>Available from</th>
        <th>Available from (db format)</th>
        <th>Price per day</th>
        <th>Description</th>
    </tr>
    <?php foreach($rooms as $item):?>
        <tr>
            <td><?php echo $item['floor'];?></td>
            <td><?php echo $item['room_number'];?></td>
            <td><?php echo Yii::$app->formatter->asBoolean($item['has_conditioner']);?></td>
            <td><?php echo Yii::$app->formatter->asBoolean($item['has_tv']);?></td>
            <td><?php echo Yii::$app->formatter->asBoolean($item['has_phone']);?></td>
            <td><?php echo Yii::$app->formatter->asDate($item['available_from']);?></td>
            <td><?php echo Yii::$app->formatter->asDate($item['available_from'],'php:Y-m-d');?></td>
            <td><?php echo Yii::$app->formatter->asCurrency($item['price_per_day'],'EUR');?></td>
            <td><?php echo $item['description'];?></td>
        </tr>
    <?php endforeach;?>
</table>

