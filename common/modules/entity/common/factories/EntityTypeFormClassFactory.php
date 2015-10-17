<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 15.10.2015
 * Time: 15:32
 */
namespace common\modules\entity\common\factories;

use common\modules\entity\common\models\EntityForms;
use common\modules\generator\entity\EntityTypeFormClassGenerator;
use Yii;
use common\modules\entity\common\models\EntityTypes;
use yii\web\NotFoundHttpException;
use common\modules\entity\common\factories\EntityTypeFormClassGenerationFactory;

class EntityTypeFormClassFactory
{
    protected static $entityTypeForm = null;
    protected static $namespace = 'frontend\runtime\generated';

    public static function get($form_id)
    {
        $entityTypeForm = self::getEntityTypeForm($form_id);
        $entityTypeFormClass = self::getClassName($entityTypeForm->code);
        if(class_exists($entityTypeFormClass)){
            return new $entityTypeFormClass;
        }else{
            if(EntityTypeFormClassGenerator::generateFile($form_id,self::$namespace,'pdb', Yii::$app->basePath.'/runtime/generated')) {
                return new $entityTypeFormClass;
            }
        }
    }

    protected static function getEntityTypeForm($id)
    {
        if (($model = EntityForms::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested entity type form does not exist.');
        }
    }

    protected static function getClassName($entityTypeCode)
    {
        return static::$namespace.'\\'.self::getName($entityTypeCode)."Form";
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