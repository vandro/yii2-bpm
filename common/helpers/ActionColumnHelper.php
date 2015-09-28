<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 17.08.2015
 * Time: 15:30
 */
namespace common\helpers;

use Yii;
use yii\helpers\Html;

class ActionColumnHelper
{
    static public function standard($url,$model,$controller,$action, $label, $icon, $params = null, $data_pjax_value = 0)
    {
        if(empty($params)){
            $urlArray = [$controller.'/'.$action,'id'=>$model['id']];
        }else {
            $urlArray = array_unshift($params, $controller . '/' . $action);
        }
//        $customUrl = Yii::$app->getUrlManager()->createUrl([$controller.'/'.$action,'id'=>$model['id']]);
        $customUrl = Yii::$app->getUrlManager()->createUrl($urlArray);
        return Html::a( '<span class="'.$icon.'"></span>', $customUrl,
            ['title' => Yii::t('yii', $label), 'data-pjax' => $data_pjax_value]);
    }

    static public function view($url,$model,$controller)
    {
        return self::standard($url,$model, $controller,'view', 'View', 'glyphicon glyphicon-eye-open');
    }

    static public function update($url,$model,$controller)
    {
        return self::standard($url,$model, $controller,'update', 'Update', 'glyphicon glyphicon-pencil');
    }

    static public function delete($url,$model,$controller)
    {
        return self::standard($url,$model, $controller,'delete', 'Delete', 'glyphicon glyphicon-trash');
    }
}