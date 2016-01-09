<?php
    use yii\helpers\Url;
    $operators = ['>=','<=','='];
    $sf = $searchFilter;
?>
<form method="post" action="<?php echo Url::to(['rooms/index-filtered']);?>">
    <input type="hidden" name="<?php echo Yii::$app->request->csrfParam;?>" value = "<?php echo Yii::$app->request->csrfToken?>"/>
    <div class="row">
        <?php
            $operator = $sf['floor']['operator'];
            $value = $sf['floor']['value'];
        ?>
        <div class="col-md-3">
            <label>Floor</label>
            <br/>
            <select name="SearchFilter[floor][operator]">
                <?php foreach($operators as $op): ?>
                    <?php $selected = ($op == $operator) ? 'selected' : '' ;?>
                    <option value="<?= $op;?>" <?= $selected;?>><?=$op;?></option>
                <?php endforeach;?>
            </select>
            <input type="text" name="SearchFilter[floor][value]" value="<?= $value;?>"/>
        </div>

        <?php
            $operator = $sf['room_number']['operator'];
            $value = $sf['room_number']['value'];
        ?>
        <div class="col-md-3">
            <label>Room number</label>
            <br/>
            <select name="SearchFilter[room_number][operator]">
                <?php foreach($operators as $op): ?>
                    <?php $selected = ($op == $operator) ? 'selected' : '' ;?>
                    <option value="<?= $op;?>" <?= $selected;?>><?=$op;?></option>
                <?php endforeach;?>
            </select>
            <input type="text" name="SearchFilter[room_number][value]" value="<?= $value;?>"/>
        </div>

        <?php
            $operator = $sf['price_per_day']['operator'];
            $value = $sf['price_per_day']['value'];
        ?>
        <div class="col-md-3">
            <label>Price per day</label>
            <br/>
            <select name="SearchFilter[price_per_day][operator]">
                <?php foreach($operators as $op): ?>
                    <?php $selected = ($op == $operator) ? 'selected' : '' ;?>
                    <option value="<?= $op;?>" <?= $selected;?>><?=$op;?></option>
                <?php endforeach;?>
            </select>
            <input type="text" name="SearchFilter[price_per_day][value]" value="<?= $value;?>"/>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-md-3">
            <input type="submit" value="filter" class="btn btn-primary"/>
            <input type="reset" value="reset" class="btn btn-primary"/>
        </div>
    </div>

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

</form>
