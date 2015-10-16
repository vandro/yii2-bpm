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

class ActiveRecordRequiredRuleFactory
{
    const PROPERTIES = 'PROPERTIES';
    const PROPERTY_NAME = 'PROPERTY_NAME';
    const TYPE = 'required';

    protected static $params;
    protected static $rulesString;
    protected static $rules;



    public static function getRuleString($params)
    {
        self::$params = $params;
        self::$rulesString = '';
        self::render();

        return self::$rulesString;
    }

    protected static function render()
    {
        if(self::$params[ActiveRecordClassGenerationFactory::RENDER_MODE] == ActiveRecordClassGenerationFactory::ACTIVE_RECORD_MODE) {
            self::rRules();
        }elseif(self::$params[ActiveRecordSearchClassGenerationFactory::RENDER_MODE] == ActiveRecordSearchClassGenerationFactory::ACTIVE_RECORD_SEARCH_MODE){
            self::rSearchRules();
        }
    }



    /**
     * @inheritdoc
     *
    public function rules()
    {
        return [
            [['order', 'region_id'], 'required'],
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
            self::$rulesString .= "], '".self::TYPE."'],\n";
        }
    }

    protected function getAllPropertiesArray()
    {
        $propertiesArray = [];
        foreach(self::$params[ActiveRecordClassGenerationFactory::PROPERTIES] as $property) {
            if(isset($property[ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULES])) {
                foreach ($property[ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULES] as $rule) {
                    if ($rule[ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULE_TYPE] == self::TYPE) {
                        $propertiesArray[] = $property[ActiveRecordClassGenerationFactory::PROPERTY_NAME];
                    }
                }
            }
        }

        return $propertiesArray;
    }

    /**
     * @inheritdoc
     *
    public function rules()
    {
        return [
            [['id', 'entity_id', 'length', 'dictionary_id'], 'integer'],
            [['title', 'code', 'type', 'options'], 'safe'],
        ];
    }*/

    protected static function rSearchRules()
    {
        self::$rulesString .= "             [[";
        foreach(self::$params[ActiveRecordClassGenerationFactory::PROPERTIES] as $property) {
            if(isset($property[ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULES])) {
                foreach ($property[ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULES] as $rule) {
                    if ($rule[ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULE_TYPE] == self::TYPE) {
                        self::$rulesString .= "'" . $property[ActiveRecordClassGenerationFactory::PROPERTY_NAME] . "', ";
                    }
                }
            }
        }
        self::$rulesString .= "], 'safe'],\n";
    }
}