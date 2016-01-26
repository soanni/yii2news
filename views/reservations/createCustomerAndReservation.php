<?php
    use yii\widgets\ActiveForm;
    use yii\jui\DatePicker;
    use app\models\Room;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
?>
<div class="room-form">
    <?php $form = ActiveForm::begin();?>
    <div class="model">
        <?php
            echo $form->errorSummary([$customer,$reservation]);
        ?>
        <h2>Customer</h2>
        <?php
            echo $form->field($customer,'name')->textInput();
            echo $form->field($customer,'surname')->textInput();
            echo $form->field($customer,'phone_number')->textInput();
        ?>
        <h2>Reservation</h2>
        <?php
            echo $form->field($reservation,'room_id')->dropDownList(ArrayHelper::map(Room::find()->all(),'id',function($room){return sprintf('Room #%d. Floor #%d',$room->room_number, $room->floor);}));
            echo $form->field($reservation,'price_per_day')->textInput();
            echo $form->field($reservation,'date_from')->widget(DatePicker::className(),['dateFormat' => 'yyyy/MM/dd']);
            echo $form->field($reservation,'date_to')->widget(DatePicker::className(),['dateFormat' => 'yyyy/MM/dd']);
        ?>
    </div>
    <div class="form-group">
        <?php echo Html::submitButton('Send',['class' => 'btn btn-primary']);?>
    </div>
    <?php ActiveForm::end();?>
</div>

