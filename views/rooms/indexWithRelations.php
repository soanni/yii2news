<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    echo Html::a('Reset',Url::to(['rooms/index-with-relations']),['class' => 'btn btn-danger']);
    echo '<br/><br/>';
?>
<div class="row">
    <!--Rooms-->
    <div class="col-md-4">
        <legend>Rooms</legend>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Floor</th>
                <th>Number</th>
                <th>Price</th>
            </tr>
            <?php foreach($rooms as $room): ?>
                <tr>
                    <td><?= Html::a('Details',Url::to(['rooms/index-with-relations','room_id' => $room->id]),['class' => 'btn btn-primary btn-xs']); ?></td>
                    <td><?= $room->floor; ?></td>
                    <td><?= $room->room_number; ?></td>
                    <td><?= Yii::$app->formatter->asCurrency($room->price_per_day,'EUR');?></td>
                </tr>
            <?php endforeach;?>
        </table>
        <?php if($roomSelected != null){ ?>
            <div class="alert alert-info">
                <b>You have selected room #<?php echo $roomSelected->id; ?></b>
            </div>
        <?php }else{ ?>
            <i>No room is selected</i>
        <?php } ?>
    </div>
    <!--Reservations-->
    <div class="col-md-4">
        <legend>Reservations</legend>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Price per day</th>
                <th>Date from</th>
                <th>Date to</th>
            </tr>
            <?php foreach($reservations as $reservation): ?>
                <tr>
                    <td><?= Html::a('Details',Url::to(['rooms/index-with-relations','reservation_id' => $reservation->id]),['class' => 'btn btn-primary btn-xs']); ?></td>
                    <td><?= Yii::$app->formatter->asCurrency($reservation->price_per_day,'EUR'); ?></td>
                    <td><?= Yii::$app->formatter->asDate($reservation->date_from,'php:Y-m-d'); ?></td>
                    <td><?= Yii::$app->formatter->asDate($reservation->date_to,'php:Y-m-d');?></td>
                </tr>
            <?php endforeach;?>
        </table>
        <?php if($reservationSelected != null){ ?>
            <div class="alert alert-info">
                <b>You have selected reservation #<?php echo $reservationSelected->id; ?></b>
            </div>
        <?php }else{ ?>
            <i>No reservation is selected</i>
        <?php } ?>
    </div>
    <!-- Customers -->
    <div class="col-md-4">
        <legend>Customers</legend>
        <table class="table">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Phone</th>
            </tr>
            <?php foreach($customers as $customer): ?>
                <tr>
                    <td><?= Html::a('Details',Url::to(['rooms/index-with-relations','customer_id' => $customer->id]),['class' => 'btn btn-primary btn-xs']); ?></td>
                    <td><?= $customer->name; ?></td>
                    <td><?= $customer->surname; ?></td>
                    <td><?= $customer->phone_number;?></td>
                </tr>
            <?php endforeach;?>
        </table>
        <?php if($customerSelected != null){ ?>
            <div class="alert alert-info">
                <b>You have selected customer #<?php echo $customerSelected->id; ?></b>
            </div>
        <?php }else{ ?>
            <i>No customer is selected</i>
        <?php } ?>
    </div>
</div>
