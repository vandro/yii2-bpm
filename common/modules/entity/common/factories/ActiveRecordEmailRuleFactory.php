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

class ActiveRecordEmailRuleFactory
{
    const PROPERTIES = 'PROPERTIES';
    const PROPERTY_NAME = 'PROPERTY_NAME';
    const TYPE = 'email';

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
            [['email'], 'email']
        ];
    }*/

    protected static function rRules()
    {
        $arProperty = self::getAllPropertiesArray();
        if(!empty($arProperty)) {
            self::$rulesString .= "             [[";
            foreach (self::getAllPropertiesArray() as $property) {
                self::$rulesString .= "'" . $property . "', ";
            }
            self::$rulesString .= "], 'email'],\n";
        }
    }

    protected function getAllPropertiesArray()
    {
        $propertiesArray = [];
        foreach(self::$params[ActiveRecordClassFactory::PROPERTIES] as $property) {
            if(isset($property[ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES])) {
                foreach ($property[ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES] as $rule) {
                    if ($rule[ActiveRecordClassFactory::PROPERTY_VALIDATION_RULE_TYPE] == self::TYPE) {
                        $propertiesArray[] = $property[ActiveRecordClassFactory::PROPERTY_NAME];
                    }
                }
            }
        }

        return $propertiesArray;
    }
}