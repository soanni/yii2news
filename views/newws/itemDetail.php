Detail item with title <?= $title;?>
<br/><br/>
<?php if(!is_null($item)) {?>
    <table border="1">
        <?php foreach($item as $key=>$value):?>
            <tr>
                <th><?= $key;?></th>
                <td><?= $value;?></td>
            </tr>
        <?php endforeach;?>
    </table>
    <br/>
    Url for this item is: <?php echo yii\helpers\Url::to(['newws/item-detail','title' => $title]);?>
<?php }else{ ?>
    <i>No item is found</i>
<?php }?>


