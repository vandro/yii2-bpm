<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 15.10.2015
 * Time: 15:32
 */
namespace common\modules\entity\common\factories;

use Yii;
use common\modules\entity\common\models\EntityTypes;
use yii\web\NotFoundHttpException;
use common\modules\entity\common\factories\EntityClassGenerationFactory;

class EntityClassFactory
{
    protected static $entityType = null;
    protected static $namespace = 'common\modules\entity\common\entities';

    public static function get($entity_id)
    {
        $entityType = self::getEntityType($entity_id);
        $entityTypeClass = self::getClassName($entityType->code);
        if(class_exists($entityTypeClass)){
            return new $entityTypeClass;
        }else{
            if(EntityClassGenerationFactory::generateFile($entity_id)) {
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
        $arName = explode("_",$nameString);
        foreach($arName as $nameItem){
            $name .= ucfirst($nameItem);
        }

        return $name;
    }
}