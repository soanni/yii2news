<?php

namespace app\controllers;

use Yii;

class NewwsController extends BaseController{
    public function actionItemsList(){
        $year = Yii::$app->request->get('year');
        $category = Yii::$app->request->get('category');
        $data = $this->data();
        $filtered = [];
        foreach($data as $d){
            if(!is_null($year) && date('Y',strtotime($d['date'])) == $year){
                $filtered[] = $d;
            }
            if(!is_null($category) && $d['category'] == $category){
                $filtered[] = $d;
            }
        }
        return $this->render('itemsList',['year' => $year, 'category' => $category, 'filtered' => $filtered]);
    }

    public function actionIndex(){
        return $this->render('index');
    }

    public function actionItemDetail(){
        $title = Yii::$app->request->get('title');
        $data = $this->data();
        $item = null;
        foreach($data as $d){
            if($d['title'] == $title){
                $item = $d;
            }
        }

        return $this->render('itemDetail',['title' => $title, 'item' => $item]);
    }

    public function data(){
        return [
            ['id' => 1,'date' => '2015-04-19','category' => 'business','title' => 'Test news of 2015-04-19'],
            ['id' => 2, 'date' => '2015-05-20', 'category' => 'shopping', 'title' => 'Test news of 2015-05-20'],
            ['id' => 3, 'date' => '2015-06-21', 'category' => 'business', 'title' => 'Test news of 2015-06-21'],
            ['id' => 4, 'date' => '2016-04-19', 'category' => 'shopping', 'title' => 'Test news of 2016-04-19'],
            ['id' => 5, 'date' => '2017-05-19', 'category' => 'business', 'title' => 'Test news of 2017-05-19'],
            ['id' => 6, 'date' => '2018-06-19', 'category' => 'shopping', 'title' => 'Test news of 2018-06-19' ]
        ];
    }

    public function actionInternationalIndex(){
        $lang = Yii::$app->request->get('lang','en');
        Yii::$app->language = $lang;
        return $this->render('internationalIndex');
    }
}