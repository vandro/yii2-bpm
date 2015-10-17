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

class ActiveRecordRequiredRuleGenerator extends AbstractActiveRecordRuleGenerator
{
    const TYPE = 'required';

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

    protected function addRules()
    {
        $arProperty = self::getAllPropertiesArray();
        if(!empty($arProperty)) {
            $this->rulesString .= "             [[";
            foreach ($arProperty as $property) {
                $this->rulesString .= "'" . $property . "', ";
            }
            $this->rulesString .= "], '".static::TYPE."'],\n";
        }
    }

    protected function getAllPropertiesArray()
    {
        $propertiesArray = [];
        foreach($this->params[AbstractClassGenerator::PROPERTIES] as $property) {
            if(isset($property[AbstractClassGenerator::PROPERTY_VALIDATION_RULES])) {
                foreach ($property[AbstractClassGenerator::PROPERTY_VALIDATION_RULES] as $rule) {
                    if ($rule[AbstractClassGenerator::PROPERTY_VALIDATION_RULE_TYPE] == static::TYPE) {
                        $propertiesArray[] = $property[AbstractClassGenerator::PROPERTY_NAME];
                    }
                }
            }
        }

        return $propertiesArray;
    }
}