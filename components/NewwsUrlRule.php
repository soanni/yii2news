<?php

namespace app\components;

use yii\web\Request;
use yii\web\UrlManager;
use yii\web\UrlRuleInterface;
use yii\base\Object;

class NewwsUrlRule extends Object implements UrlRuleInterface{

    public function createUrl($manager, $route, $params){
        if($route === 'newws/item-detail'){
            if(isset($params['title'])){
                return 'newws/' . $params['title'];
            }
        }
        return false;
    }


    public function parseRequest($manager, $request){
        $pathInfo = $request->getPathInfo();
        if (preg_match('%^([^\/]*)\/([^\/]*)$%', $pathInfo, $matches)) {
            if($matches[1] == 'newws'){
                $params = ['title' => $matches[2]];
                return ['newws/item-detail',$params];
            }else{
                return false;
            }
        }
        return false;
    }

}