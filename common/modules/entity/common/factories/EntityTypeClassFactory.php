<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 15.10.2015
 * Time: 15:32
 */
namespace common\modules\entity\common\factories;

use Yii;
use common\modules\generator\entity\EntityTypeClassGenerator;
use common\modules\entity\common\models\EntityTypes;
use yii\web\NotFoundHttpException;


class EntityTypeClassFactory
{
    protected static $namespace = 'frontend\runtime\generated';

    public static function get($entity_id)
    {
        $entityType = self::getEntityType($entity_id);
        $entityTypeClass = self::getClassName($entityType->code);
        if(class_exists($entityTypeClass)){
            return new $entityTypeClass;
        }else{
            if(EntityTypeClassGenerator::generateFile($entity_id,self::$namespace,$entityType->database->code, Yii::$app->basePath.'/runtime/generated')) {
                return new $entityTypeClass;
            }
        }
    }

    protected static function getEntityType($id)
    {
        if (($model = EntityTypes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested entity type does not exist.');
        }
    }

    protected static function getClassName($entityTypeCode)
    {
        return static::$namespace.'\\'.self::getName($entityTypeCode);
    }

    private static function getName($nameString)
    {
        $name = '';
        $arName = explode("_",trim($nameString));
        foreach($arName as $nameItem){
            $name .= ucfirst($nameItem);
        }

        return $name;
    }
}