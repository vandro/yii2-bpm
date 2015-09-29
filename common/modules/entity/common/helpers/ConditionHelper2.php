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

class ConditionHelper2
{
    protected static $entity = null;
    protected static $entityModel = null;
    protected static $fieldValue = null;

    public static function resolve($condition, $taskId)
    {
        self::setEntityFieldValue($condition, $taskId);
        $operator = $condition->operator;
        return self::$operator($condition);
    }

    protected static function setEntityFieldValue($condition, $taskId)
    {
        $entityModel = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->getFullEntityModelByTaskId($condition->operand_1_entity_id, $taskId);

        self::$entityModel = $entityModel;
        self::$fieldValue = $entityModel->{$condition->operand1Field->code};
    }

    protected static function equal($condition)
    {
        return (self::$fieldValue == $condition->operand_2);
    }

    protected static function not_equal($condition)
    {
        return (self::$fieldValue != $condition->operand_2);
    }

    public static function identical($condition)
    {
        return (self::$fieldValue === $condition->operand_2);
    }

    public static function not_identical($condition)
    {
        return (self::$fieldValue !== $condition->operand_2);
    }

    public static function greater_than($condition)
    {
        return (self::$fieldValue > $condition->operand_2);
    }

    public static function less_than($condition)
    {
        return (self::$fieldValue < $condition->operand_2);
    }

    public static function greater_than_or_equal_to($condition)
    {
        return (self::$fieldValue >= $condition->operand_2);
    }

    public static function less_than_or_equal_to($condition)
    {
        return (self::$fieldValue <= $condition->operand_2);
    }

    public static function contains($condition)
    {
        return (strpos(self::$fieldValue,$condition->operand_2) == false?false:true);
    }

    public static function not_contains($condition)
    {
        return (strpos(self::$fieldValue,$condition->operand_2) != false?false:true);
    }

    public static function begin_with($condition)
    {
        $length = strlen($condition->operand_2);
        return (substr(self::$fieldValue, 0, $length) === $condition->operand_2);
    }

    public static function end_with($condition)
    {
        $length = strlen($condition->operand_2);
        if ($length == 0) {
            return true;
        }

        return (substr(self::$fieldValue, -$length) === $condition->operand_2);
    }
}