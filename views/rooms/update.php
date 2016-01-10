<?php
    $this->params['breadcrumbs'][] = 'Rooms list';
    $this->params['breadcrumbs'][] = 'Room update';
?>
<div class="row">
    <div class="col-lg-12">
        <h2>Update a room</h2>
        <?php echo $this->render('_form',['model' => $model,'type' => $type]);?>
    </div>
</div>
