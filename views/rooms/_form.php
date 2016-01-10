<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(['options' => ['id' => 'room-form','enctype' => 'multipart/form-data']]); ?>
<?= $form->field($model,'floor')->textInput();?>
<?= $form->field($model,'room_number')->textInput();?>
<?= $form->field($model, 'has_conditioner')->checkbox();?>
<?= $form->field($model, 'has_tv')->checkbox();?>
<?= $form->field($model, 'has_phone')->checkbox();?>
<?= $form->field($model, 'available_from')->textInput();?>
<?= $form->field($model, 'price_per_day')->textInput();?>
<?= $form->field($model, 'description')->textarea();?>
<?= $form->field($model, 'fileImage')->fileInput();?>
<?= Html::submitButton($type,['class' => 'btn btn-success']);?>
<?php ActiveForm::end();?>