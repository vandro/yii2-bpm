<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 23.09.2015
 * Time: 12:03
 */
namespace common\modules\generator\models;

use Yii;

class ActiveRecordSearchClassGenerator extends AbstractClassGenerator
{
    const RENDER_MODE_VALUE = 'ACTIVE_RECORD_SEARCH_MODE';

    public function __construct($params)
    {
        $arParams = $params;
        $arParams[self::USED_CLASSES] = [
            'Yii',
            'yii\\base\\Model',
            'yii\\data\\ActiveDataProvider',
            $params[self::NAME_SPACE]."\\".$params[self::CLASS_NAME],
        ];
        $arParams[self::EXTEND_CLASS_NAME] = $params[self::CLASS_NAME];
        $arParams[self::CLASS_NAME] = $params[self::CLASS_NAME]."Search";
        parent::__construct($arParams);
    }


    protected function addBeforeClassBegin()
    {
        $this->classString .= "/**\n";
        $this->classString .= " * ".$this->params[self::CLASS_NAME]."Search represents the model behind the search form about `".$this->params[self::NAME_SPACE]."\\".$this->params[self::CLASS_NAME]."`..\n";
        $this->classString .= " */\n";
    }

    protected function addInClass()
    {
        $this->addRules();
        $this->addScenarios();
        $this->addSearch();
        $this->addSearchLink();
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

    protected function addRules()
    {
        $this->classString .= "    /**\n";
        $this->classString .= "     * @inheritdoc\n";
        $this->classString .= "     */\n";
        $this->classString .= "    public function rules()\n";
        $this->classString .= "    {\n";
        $this->classString .= "         return [\n";
        if(isset($this->params[self::PROPERTIES_VALIDATION_RULES])) {
            foreach ($this->params[self::PROPERTIES_VALIDATION_RULES] as $rule) {
                $ruleClass = $rule[self::CLASS_NAME];
                $ruleObject = new $ruleClass($this->params);
                $this->classString .= $ruleObject->getRuleString($this->params);
            }
        }
        $this->classString .= "         ];\n";
        $this->classString .= "    }\n\n";
    }

    /**
     * @inheritdoc
     *
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }*/

    protected function addScenarios()
    {
        $this->classString .= "    /**\n";
        $this->classString .= "     * @inheritdoc\n";
        $this->classString .= "     */\n";
        $this->classString .= "    public function scenarios()\n";
        $this->classString .= "    {\n";
        $this->classString .= "         return Model::scenarios();\n";
        $this->classString .= "    }\n\n";
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     *
    public function search($params)
    {
        $query = EntityFields::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'entity_id' => $this->entity_id,
            'length' => $this->length,
            'dictionary_id' => $this->dictionary_id,
        ]);

        $query
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'options', $this->options]);

        return $dataProvider;
    }*/

    protected function addSearch()
    {
        $this->classString .= "    /**\n";
        $this->classString .= "     * Creates data provider instance with search query applied\n";
        $this->classString .= "     *\n";
        $this->classString .= "     * @param array \$params\n";
        $this->classString .= "     *\n";
        $this->classString .= "     * @return ActiveDataProvider\n";
        $this->classString .= "     */\n";
        $this->classString .= "    public function search(\$params)\n";
        $this->classString .= "    {\n";
        $this->classString .= "         \$query = ".$this->params[self::CLASS_NAME]."::find();\n";
        $this->classString .= "         \n";
        $this->classString .= "         \$dataProvider = new ActiveDataProvider([\n";
        $this->classString .= "             'query' => \$query,\n";
        $this->classString .= "         ]);\n";
        $this->classString .= "         \n";
        $this->classString .= "         \$this->load(\$params);\n";
        $this->classString .= "         \n";
        $this->classString .= "         if (!\$this->validate()) {\n";
        $this->classString .= "             return \$dataProvider;\n";
        $this->classString .= "         }\n";
        $this->classString .= "         \n";
        $this->classString .= "         \$query->andFilterWhere([\n";
        foreach($this->params[self::PROPERTIES] as $property) {
            if(isset($property[self::PROPERTY_TYPE]) && $property[self::PROPERTY_TYPE] == 'integer') {
                $this->classString .= "             '" . $property[self::PROPERTY_NAME] . "' => \$this->" . $property[self::PROPERTY_NAME] . ",\n";
            }
        }
        $this->classString .= "         ]);\n";
        $this->classString .= "         \n";
        if($this->hasStringPropertyType()) {
            $this->classString .= "         \$query\n";
            foreach ($this->params[self::PROPERTIES] as $property) {
                if (isset($property[self::PROPERTY_TYPE]) && $property[self::PROPERTY_TYPE] == 'string') {
                    $this->classString .= "           ->andFilterWhere(['like', '" . $property[self::PROPERTY_NAME] . "', \$this->" . $property[self::PROPERTY_NAME] . "])\n";
                }
            }
            $this->classString .= "         ;\n";
        }
        $this->classString .= "         \n";
        $this->classString .= "         return \$dataProvider;\n";
        $this->classString .= "    }\n\n";
    }

    protected function addSearchLink()
    {
        $this->classString .= "    /**\n";
        $this->classString .= "     * Creates data provider instance with search query applied\n";
        $this->classString .= "     *\n";
        $this->classString .= "     * @param array \$params\n";
        $this->classString .= "     *\n";
        $this->classString .= "     * @return ActiveDataProvider\n";
        $this->classString .= "     */\n";
        $this->classString .= "    public function searchLink(\$params)\n";
        $this->classString .= "    {\n";
        $this->classString .= "         \$query = ".$this->params[self::CLASS_NAME]."::find();\n";
        $this->classString .= "         \n";
        $this->classString .= "         \$dataProvider = new ActiveDataProvider([\n";
        $this->classString .= "             'query' => \$query,\n";
        $this->classString .= "         ]);\n";
        $this->classString .= "         \n";
        $this->classString .= "         \$arParams['".$this->params[self::CLASS_NAME]."'] = (array) \$params;\n";
        $this->classString .= "         \n";
        $this->classString .= "         \$this->load(\$arParams,'".$this->params[self::CLASS_NAME]."');\n";
        $this->classString .= "         \n";
        $this->classString .= "         if (!\$this->validate()) {\n";
        $this->classString .= "             return \$dataProvider;\n";
        $this->classString .= "         }\n";
        $this->classString .= "         \n";
        $this->classString .= "         \$query->andFilterWhere([\n";
        foreach($this->params[self::PROPERTIES] as $property) {
            if(isset($property[self::PROPERTY_TYPE]) && $property[self::PROPERTY_TYPE] == 'integer') {
                $this->classString .= "             '" . $property[self::PROPERTY_NAME] . "' => \$this->" . $property[self::PROPERTY_NAME] . ",\n";
            }
        }
        $this->classString .= "         ]);\n";
        $this->classString .= "         \n";
        if($this->hasStringPropertyType()) {
            $this->classString .= "         \$query\n";
            foreach ($this->params[self::PROPERTIES] as $property) {
                if (isset($property[self::PROPERTY_TYPE]) && $property[self::PROPERTY_TYPE] == 'string') {
                    $this->classString .= "           ->andFilterWhere(['like', '" . $property[self::PROPERTY_NAME] . "', \$this->" . $property[self::PROPERTY_NAME] . "])\n";
                }
            }
            $this->classString .= "         ;\n";
        }
        $this->classString .= "         \n";
        $this->classString .= "         return \$dataProvider;\n";
        $this->classString .= "    }\n\n";
    }

    protected function hasStringPropertyType()
    {
        foreach($this->params[self::PROPERTIES] as $property) {
            if (isset($property[self::PROPERTY_TYPE]) && $property[self::PROPERTY_TYPE] == 'string') {
                return true;
            }
        }
    }
}