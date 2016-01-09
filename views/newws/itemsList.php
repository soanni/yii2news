<?php
    if(!is_null($year)){
        echo "<b>List for year: $year</b>";
    }
    if(!is_null($category)){
        echo "<b>List for category: $category</b>";
    }
?>
<br/>
<table border="1">
    <tr>
        <th>Date</th>
        <th>Category</th>
        <th>Title</th>
    </tr>
    <?php foreach($filtered as $d):?>
        <tr>
            <td><?= $d['date'];?></td>
            <td><?= $d['category'];?></td>
            <td><?= \yii\helpers\Html::a($d['title'],\yii\helpers\Url::to(['newws/item-detail','title' => $d['title']]));?></td>
        </tr>
    <?php endforeach; ?>
</table>

