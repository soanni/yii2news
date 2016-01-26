<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
?>
<div class="customers-form">
    <?php $form = ActiveForm::begin();?>
    <div class="model">
        <?php for($i = 0; $i < sizeof($models); $i++){?>
            <?php $model = $models[$i];?>
            <h3>Model #<?= $i + 1;?></h3>
            <hr/>
            <?php echo $form->field($model,"[$i]name")->textInput();?>
            <?php echo $form->field($model,"[$i]surname")->textInput();?>
            <?php echo $form->field($model,"[$i]phone_number")->textInput();?>
            <br/>
        <?php }?>
    </div>
    <div class="form-group">
        <?php echo Html::submitButton('Save',['class' => 'btn btn-primary']); ?>
    </div>
</div>


