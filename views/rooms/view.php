<?php
    use yii\helpers\Html;
    $this->params['breadcrumbs'][] = 'Rooms list';
    $this->params['breadcrumbs'][] = 'Room detail';
?>
<table class="table">
    <tr>
        <th>Room id</th>
        <td><?= $room->id;?></td>
    </tr>
    <tr>
        <th>Room floor</th>
        <td><?= $room->floor;?></td>
    </tr>
    <tr>
        <th>Room number</th>
        <td><?= $room['room_number'];?></td>
    </tr>
    <tr>
        <th>Has conditioner</th>
        <td><?= Yii::$app->formatter->asBoolean($room->has_conditioner);?></td>
    </tr>
    <tr>
        <th>Has tv</th>
        <td><?= Yii::$app->formatter->asBoolean($room->has_tv);?></td>
    </tr>
    <tr>
        <th>Has phone</th>
        <td><?= Yii::$app->formatter->asBoolean($room->has_phone);?></td>
    </tr>
    <tr>
        <th>Availbale from</th>
        <td><?= Yii::$app->formatter->asDate($room->available_from,'php:Y-m-d');?></td>
    </tr>
    <tr>
        <th>Price</th>
        <td><?= Yii::$app->formatter->asCurrency($room->price_per_day,'EUR');?></td>
    </tr>
    <tr>
        <th>Description</th>
        <td><?= $room->description; ?></td>
    </tr>
    <tr>
        <th>Image</th>
        <td><?= Html::img('@uploadedFilesDir/' . $room->fileImage);?></td>
    </tr>
</table>
