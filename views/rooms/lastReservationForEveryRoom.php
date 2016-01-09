<table class="table">
    <tr>
        <th>RoomId</th>
        <th>CustomerId</th>
        <th>Price per day</th>
        <th>Date from</th>
        <th>Date to</th>
        <th>Reservation date</th>
    </tr>
    <?php foreach($rooms as $room): ?>
        <?php $reservation = $room->lastReservation;?>
        <tr>
            <td><?= $reservation['room_id'];?></td>
            <td><?= $reservation['customer_id'];?></td>
            <td><?= Yii::$app->formatter->asCurrency($reservation['price_per_day'],'EUR');?></td>
            <td><?= Yii::$app->formatter->asDate($reservation['date_from'],'php:Y-m-d')?></td>
            <td><?= Yii::$app->formatter->asDate($reservation['date_to'],'php:Y-m-d')?></td>
            <td><?= Yii::$app->formatter->asDate($reservation['reservation_date'],'php:Y-m-d H:i:s')?></td>
        </tr>
    <?php endforeach;?>
</table>