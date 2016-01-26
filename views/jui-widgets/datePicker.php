<?php
    use yii\jui\DatePicker;
?>
<div class="row">
    <div class="col-lg-6">
        <h3>Date Picker from Value<br/> (using MM/dd/yyyy format and English language)</h3>
        <?php
        $value = date('Y-m-d');
        echo DatePicker::widget([
            'name' => 'from_date',
            'value' => $value,
            'language' => 'en',
            'dateFormat' => 'MM/dd/yyyy'
        ]);
        ?>
    </div>
    <div class="col-lg-6">
        <?php
            if($reservationUpdated){
                echo \yii\bootstrap\Alert::widget(
                    [
                        'options' => ['class' => 'alert-success'],
                        'body' => 'Reservation successfully updated'
                    ]);
            }
            $form = \yii\widgets\ActiveForm::begin();
        ?>
        <h3>Date Picker from Model<br/> (using dd/MM/yyyy format and italian language)</h3>
        <br/>
        <label>Date From</label>
        <?php
            echo DatePicker::widget([
                'model' => $model,
                'attribute' => 'date_from',
                'language' => 'it',
                'dateFormat' => 'dd/MM/yyyy'
            ]);
        ?>
        <br/>
        <br/>
        <?php
            echo $form->field($model,'date_to')->widget(DatePicker::className(),['language' => 'it', 'dateFormat' => 'dd/MM/yyyy']);
            echo \yii\bootstrap\Html::submitButton('Send',['class' => 'btn btn-primary']);
            \yii\widgets\ActiveForm::end();
        ?>
    </div>
</div>

