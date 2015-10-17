<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 15.10.2015
 * Time: 15:32
 */
namespace common\modules\entity\common\factories;

use common\modules\entity\common\models\EntityForms;
use common\modules\entity\common\models\EntityViews;
use common\modules\generator\entity\EntityTypeViewClassGenerator;
use Yii;
use common\modules\entity\common\models\EntityTypes;
use yii\web\NotFoundHttpException;
use common\modules\entity\common\factories\EntityTypeFormClassGenerationFactory;

class EntityTypeViewClassFactory
{
    protected static $namespace = 'frontend\runtime\generated';

    public static function get($view_id)
    {
        $entityTypeView = self::getEntityTypeView($view_id);
        $entityTypeViewClass = self::getClassName($entityTypeView->code);
        if(class_exists($entityTypeViewClass)){
            return new $entityTypeViewClass;
        }else{
            if(EntityTypeViewClassGenerator::generateFile($view_id,self::$namespace,'pdb', Yii::$app->basePath.'/runtime/generated')) {
                return new $entityTypeViewClass;
            }
        }
    }

    protected static function getEntityTypeView($id)
    {
        if (($model = EntityViews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested entity type view does not exist.');
        }
    }

    protected static function getClassName($entityTypeCode)
    {
        return static::$namespace.'\\'.self::getName($entityTypeCode)."View";
    }

    private static function getName($nameString)
    {
        $name = '';
        $arName = explode("_",$nameString);
        foreach($arName as $nameItem){
            $name .= ucfirst($nameItem);
        }

        return $name;
    }
}