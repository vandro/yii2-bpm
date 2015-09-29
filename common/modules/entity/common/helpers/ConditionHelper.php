<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 29.09.2015
 * Time: 10:19
 */
namespace common\modules\entity\common\helpers;

use Yii;
use common\modules\entity\common\config\Config;
use common\modules\entity\common\models\TasksEntitiesLink;

class ConditionHelper
{
    protected static $entity = null;
    protected static $entityModel = null;
    protected static $fieldValue = null;

    public static function resolve($condition, $taskId)
    {
        self::setEntityFieldValue($condition, $taskId);

        switch($condition->operator){
            case 'equal':
                return self::equal($condition);
            case 'notequal':
                return self::notEqual($condition);
            default:
                return false;
        }
        return self::$condition;
    }

    protected static function setEntityFieldValue($condition, $taskId)
    {

        $entity = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->getInstanceById($condition->operand1Entity);
        $entityItemLink = TasksEntitiesLink::find()->where(['task_id' => $taskId, 'entity_id' => $condition->operand1Entity])->one();
        if (($itemModel = $entity::findOne($entityItemLink->entity_item_id)) !== null) {
            return $itemModel;
        } else {
            throw new NotFoundHttpException('The requested entity item does not exist.');
        }

        self::$entity = $entity;
        self::$entityModel = $itemModel;
        self::$fieldValue = $itemModel->{$condition->operand1Field->code};
    }

    protected static function equal($condition)
    {
        return self::getEntityFieldValue($condition) == $condition->operand2;
    }

    protected static function notEqual($condition)
    {
        return self::getEntityFieldValue($condition) != $condition->operand2;
    }
}