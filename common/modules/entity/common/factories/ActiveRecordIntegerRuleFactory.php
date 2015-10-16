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

class ActiveRecordIntegerRuleFactory
{
    const MAX = 'MAX';
    const MIN ='MIN';
    const PROPERTIES = 'PROPERTIES';
    const PROPERTY_NAME = 'PROPERTY_NAME';
    const TYPE = 'integer';

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
        foreach(self::$params[ActiveRecordClassGenerationFactory::PROPERTIES] as $property) {
            if(isset($property[ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULES])) {
                foreach ($property[ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULES] as $rule) {
                    if ($rule[ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULE_TYPE] == self::TYPE) {
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
                        $maxMinPropertiesArray[$key][self::PROPERTIES][] = $property[ActiveRecordClassGenerationFactory::PROPERTY_NAME];
                    }
                }
            }
        }

        return $maxMinPropertiesArray;
    }

    /**
     * @inheritdoc
     **
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
        self::$rulesString .= "], '".self::TYPE."'],\n";
    }
}