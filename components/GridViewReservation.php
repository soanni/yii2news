<?php

namespace app\components;

use yii\grid\GridView;


class GridViewReservation extends GridView{
    public function renderTableFooter(){
        $priceColumn = null;
        $html = '';
        foreach($this->columns as $c){
            if(get_class($c) == 'yii\grid\DataColumn'){
                if($c->attribute == 'price_per_day'){
                    $priceColumn = $c;
                }
            }
        }

        $html .= '<tfoot><tr>';
        $html .= "<td colspan='2' style='text-align: center'><b>Average:<b/><td/>";
        $html .= $priceColumn->renderFooterCell();
        $html .= '<td colspan="3"><i>this space was intentionally left blank<i><td/>';
        $html .= '<tr/><tfoot/>';
        return $html;
    }
}