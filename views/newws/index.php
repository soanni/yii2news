<?php
    use yii\helpers\Url;
    use yii\helpers\Html;
?>

<b>Filter data by year:</b>
<br/>
<ul>
    <?php
        $currentYear = date('Y');
        for($year = $currentYear; $year > ($currentYear-5);$year--){?>
            <li><?php echo Html::a('List items for year ' . $year, Url::to(['newws/items-list', 'year' => $year]));?></li>
        <?php }?>
</ul>

<b>Filter data by category:</b>
<br/>
<ul>
    <?php
        $categories = ['shopping','business'];
        foreach($categories as $c){ ?>
            <li><?php echo Html::a('List items for category ' . $c, Url::to(['newws/items-list', 'category' => $c]));?></li>
        <?php }?>
</ul>
