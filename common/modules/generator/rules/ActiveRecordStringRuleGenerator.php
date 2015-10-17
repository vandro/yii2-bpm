<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 23.09.2015
 * Time: 12:03
 */
namespace common\modules\generator\rules;

use Yii;
use common\modules\generator\models\AbstractClassGenerator;

class ActiveRecordStringRuleGenerator extends AbstractActiveRecordRuleGenerator
{
    const MAX = 'MAX';
    const MIN ='MIN';
    const TYPE = 'string';

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

    protected function addRules()
    {
        $arMinMax = $this->getAllMaxMinArray();
        if (!empty($arMinMax)) {
            foreach ($arMinMax as $item) {
                $this->rulesString .= "             [[";
                foreach ($item[self::PROPERTIES] as $property) {
                    $this->rulesString .= "'" . $property . "', ";
                }
                $this->rulesString .= "], '" . static::TYPE . "'";
                if (isset($item[self::MAX])) {
                    $this->rulesString .= ", 'max' => " . $item[self::MAX];
                }
                if (isset($item[self::MIN])) {
                    $this->rulesString .= ", 'min' => " . $item[self::MIN];
                }
                $this->rulesString .= "],\n";
            }
        }
    }

    protected function getAllMaxMinArray()
    {
        $maxMinArray = [];
        $maxMinPropertiesArray = [];
        foreach($this->params[AbstractClassGenerator::PROPERTIES] as $property) {
            if(isset($property[AbstractClassGenerator::PROPERTY_VALIDATION_RULES])) {
                foreach ($property[AbstractClassGenerator::PROPERTY_VALIDATION_RULES] as $rule) {
                    if ($rule[AbstractClassGenerator::PROPERTY_VALIDATION_RULE_TYPE] == static::TYPE) {
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
                        $maxMinPropertiesArray[$key][self::PROPERTIES][] = $property[AbstractClassGenerator::PROPERTY_NAME];
                    }
                }
            }
        }

        return $maxMinPropertiesArray;
    }
}