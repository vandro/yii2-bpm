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
use common\modules\generator\models\ActiveRecordClassGenerator;
use common\modules\generator\models\ActiveRecordSearchClassGenerator;

abstract class AbstractActiveRecordRuleGenerator
{
    const PROPERTIES = 'PROPERTIES';
    const PROPERTY_NAME = 'PROPERTY_NAME';
    const TYPE = 'type'; // Эту константу необходимо переопределить в дочернем классе

    protected $params;
    protected $rulesString;
    protected $rules;

    public function __construct($params)
    {
        $this->params = $params;
        $this->rulesString = '';
    }

    public function getRuleString()
    {
        $this->render();
        return $this->rulesString;
    }

    protected function render()
    {
        if($this->hasRule()) {
            if ($this->params[AbstractClassGenerator::RENDER_MODE] == ActiveRecordClassGenerator::RENDER_MODE_VALUE) {
                $this->addRules();
            } elseif ($this->params[AbstractClassGenerator::RENDER_MODE] == ActiveRecordSearchClassGenerator::RENDER_MODE_VALUE) {
                $this->addSearchRules();
            }
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

    abstract protected function addRules();

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

    protected function addSearchRules()
    {
        $this->rulesString .= "             [[";
        foreach ($this->params[AbstractClassGenerator::PROPERTIES] as $property) {
            if (isset($property[AbstractClassGenerator::PROPERTY_VALIDATION_RULES])) {
                foreach ($property[AbstractClassGenerator::PROPERTY_VALIDATION_RULES] as $rule) {
                    if ($rule[AbstractClassGenerator::PROPERTY_VALIDATION_RULE_TYPE] == static::TYPE) {
                        $this->rulesString .= "'" . $property[AbstractClassGenerator::PROPERTY_NAME] . "', ";
                    }
                }
            }
        }
        $this->rulesString .= "], '" . static::TYPE . "'],\n";
    }

    protected function hasRule()
    {
        foreach($this->params[AbstractClassGenerator::PROPERTIES] as $property) {
            foreach ($property[AbstractClassGenerator::PROPERTY_VALIDATION_RULES] as $rule) {
                if ($rule[AbstractClassGenerator::PROPERTY_VALIDATION_RULE_TYPE] == static::TYPE) {
                    return true;
                }
            }
        }
    }
}