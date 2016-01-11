<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Room;


class TestSqliteController extends Controller{
    public function actionCreateRoomTable(){
        $sql = "CREATE TABLE IF NOT EXISTS room (id int not null, floor int not null, room_number int not null, has_conditioner int not null,has_tv int not null, has_phone int not null, available_from date not null, price_per_day float, description text,fileImage text)";
        \Yii::$app->dbSqlite->createCommand($sql)->execute();
        echo 'Room table was created in dbSqlite';
    }

    public function actionBackupRoomTable(){
        $sql = "CREATE TABLE IF NOT EXISTS room (id int not null, floor int not null, room_number int not null, has_conditioner int not null,has_tv int not null, has_phone int not null, available_from date not null, price_per_day float, description text,fileImage text)";
        \Yii::$app->dbSqlite->createCommand($sql)->execute();
        $sql = 'DELETE FROM room';
        \Yii::$app->dbSqlite->createCommand($sql)->execute();
        $rooms = Room::find()->all();
        foreach($rooms as $room) {
            \Yii::$app->dbSqlite->createCommand()->insert('room',$room->attributes)->execute();
        }
    }
}