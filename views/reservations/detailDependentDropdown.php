<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use yii\widgets\ActiveForm;
    use app\models\Customer;
    use app\models\Reservation;

    $urlReservationsByCustomer = Url::to(['reservations/ajax-dropdown-list-by-customer-id']);
    $this->registerJs("
        $('#reservation-customer_id').change(function(ev){
            $('#detail').hide();
            var customerId = $(this).val();
            $.get(
                '{$urlReservationsByCustomer}',
                {'customer_id' : customerId},
                function(data){
                    $('#reservation-id').html(data);
                }
            );
            ev.preventDefault();
        });
         $('#reservation-id').change(function(ev){
            $(this).parents('form').submit();
            ev.preventDefault();
         });
     ");
?>

<div class="customer-form">
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => false,
        'enableClientValidation' => false,
        'options' => ['data-pjax' => '']]);?>
    <?php $customers = Customer::find()->all(); ?>
    <?php echo $form->field($model,'customer_id')->dropDownList(ArrayHelper::map($customers,'id','nameAndSurname'),['prompt' => '---choose'])?>
    <?php $reservations = Reservation::findAll(['customer_id' => $model->customer_id]);?>
    <?php echo $form->field($model,'id')->label('Reservation ID')->dropDownList(ArrayHelper::map($reservations,'id','description'),['prompt' => '---choose'])?>
    <div id="detail">
        <?php if($showDetail){?>
            <hr/>
            <h2>Reservation detail</h2>
            <table>
                <tr>
                    <td>Price per day</td>
                    <td><?php echo $model->price_per_day;?></td>
                </tr>
            </table>
        <?php }?>
    </div>
    <?php ActiveForm::end();?>
</div>
