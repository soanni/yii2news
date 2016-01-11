<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2news',
    'username' => 'root',
    'password' => 'jd5xugLMrr',
    'charset' => 'utf8',
    'on afterOpen' => function($event){
        $event->sender->createCommand("SET time_zone = '+00:00'")->execute();
    }
];
