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
            case 'not_equal':
                return self::notEqual($condition);
            case 'identical':
                return self::identical($condition);
            case 'not_identical':
                return self::notIdentical($condition);
            case 'greater_than':
                return self::greaterThan($condition);
            case 'less_than':
                return self::lessThan($condition);
            case 'greater_than_or_equal_to':
                return self::greaterThanOrEqualTo($condition);
            case 'less_than_or_equal_to':
                return self::lessThanOrEqualTo($condition);
            case 'contains':
                return self::contains($condition);
            case 'not_contains':
                return self::notContains($condition);
            case 'begin_with':
                return self::beginWith($condition);
            case 'end_with':
                return self::endWith($condition);
            default:
                return false;
        }
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

    protected static function notEqual($condition)
    {
        return (self::$fieldValue != $condition->operand_2);
    }

    public static function identical($condition)
    {
        return (self::$fieldValue === $condition->operand_2);
    }

    public static function notIdentical($condition)
    {
        return (self::$fieldValue !== $condition->operand_2);
    }

    public static function greaterThan($condition)
    {
        return (self::$fieldValue > $condition->operand_2);
    }

    public static function lessThan($condition)
    {
        return (self::$fieldValue < $condition->operand_2);
    }

    public static function greaterThanOrEqualTo($condition)
    {
        return (self::$fieldValue >= $condition->operand_2);
    }

    public static function lessThanOrEqualTo($condition)
    {
        return (self::$fieldValue <= $condition->operand_2);
    }

    public static function contains($condition)
    {
        return (strpos(self::$fieldValue,$condition->operand_2) == false?false:true);
    }

    public static function notContains($condition)
    {
        return (strpos(self::$fieldValue,$condition->operand_2) != false?false:true);
    }

    public static function beginWith($condition)
    {
        $length = strlen($condition->operand_2);
        return (substr(self::$fieldValue, 0, $length) === $condition->operand_2);
    }

    public static function endWith($condition)
    {
        $length = strlen($condition->operand_2);
        if ($length == 0) {
            return true;
        }

        return (substr(self::$fieldValue, -$length) === $condition->operand_2);
    }
}