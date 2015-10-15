<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 23.09.2015
 * Time: 12:03
 */
namespace common\modules\entity\common\factories;

use common\helpers\DebugHelper;
use Yii;

class ActiveRecordStringRuleFactory
{
    const MAX = 'MAX';
    const MIN ='MIN';
    const PROPERTIES = 'PROPERTIES';
    const PROPERTY_NAME = 'PROPERTY_NAME';
    const TYPE = 'string';

    protected static $params;
    protected static $rulesString;
    protected static $rules;



    public static function getRuleString($params)
    {
        self::$params = $params;
        self::render();

        return self::$rulesString;
    }

    protected static function render()
    {
        self::rRules();
    }



    /**
     * @inheritdoc
     *
    public function rules()
    {
        return [
            [['order', 'region_id'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }*/

    protected static function rRules()
    {
        $arMinMax = self::getAllMaxMinArray();
        if(!empty($arMinMax)) {
            foreach (self::getAllMaxMinArray() as $item) {
                self::$rulesString .= "             [[";
                foreach ($item[self::PROPERTIES] as $property) {
                    self::$rulesString .= "'" . $property . "', ";
                }
                self::$rulesString .= "], '".self::TYPE."'";
                if (isset($item[self::MAX])) {
                    self::$rulesString .= ", 'max' => " . $item[self::MAX];
                }
                if (isset($item[self::MIN])) {
                    self::$rulesString .= ", 'min' => " . $item[self::MIN];
                }
                self::$rulesString .= "],\n";
            }
        }
    }

    protected function getAllMaxMinArray()
    {
        $maxMinArray = [];
        $maxMinPropertiesArray = [];
        foreach(self::$params[ActiveRecordClassFactory::PROPERTIES] as $property) {
            if(isset($property[ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES])) {
                foreach ($property[ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES] as $rule) {
                    if ($rule[ActiveRecordClassFactory::PROPERTY_VALIDATION_RULE_TYPE] == self::TYPE) {
                        $key = 'key';
                        $maxMin = [];
                        if (isset($rule[self::MAX])) {
                            $maxMin[self::MAX] = $rule[self::MAX];
                            $key .= $rule[self::MAX];
                        }
                        if (isset($rule[self::MIN])) {
                            $maxMin[self::MIN] = $rule[self::MIN];
                            $key .= $rule[self::MIN];
                        }
                        if (!in_array($maxMin, $maxMinArray) && !empty($maxMin)) {
                            $maxMinArray[] = $maxMin;
                            $maxMinPropertiesArray[$key] = $maxMin;
                        }
                        $maxMinPropertiesArray[$key][self::PROPERTIES][] = $property[ActiveRecordClassFactory::PROPERTY_NAME];
                    }
                }
            }
        }

        return $maxMinPropertiesArray;
    }
}