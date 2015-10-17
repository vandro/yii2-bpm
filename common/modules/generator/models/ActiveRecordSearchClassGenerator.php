<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 23.09.2015
 * Time: 12:03
 */
namespace common\modules\entity\common\factories;

use Yii;
use common\modules\generator\models\AbstractClassGenerator;

class ActiveRecordSearchClassGenerator extends AbstractClassGenerator
{
    const RENDER_MODE_VALUE = 'ACTIVE_RECORD_SEARCH_MODE';

    public function __construct($params)
    {
        $params[self::USED_CLASSES] = [
            'Yii',
            'yii\\base\\Model',
            'yii\\data\\ActiveDataProvider',
            'yii\\data\\ActiveDataProvider',
            $params[self::NAME_SPACE]."\\".$params[self::CLASS_NAME],
        ];
        $params[self::EXTEND_CLASS_NAME] = $params[self::CLASS_NAME];
        $params[self::CLASS_NAME] = $params[self::CLASS_NAME]."Search";
        parent::__construct($params);
    }


    protected function addBeforeClassBegin()
    {
        $arProperties = [];
        $this->classString .= "/**\n";
        if(isset($this->params[self::TABLE_NAME])) {
            $this->classString .= " * This is the model class for table \"" . $this->params[self::TABLE_NAME] . "\".\n";
        }
        $this->classString .= " *\n";
        if(isset($this->params[self::PROPERTIES])) {
            foreach ($this->params[self::PROPERTIES] as $property) {
                if (!in_array($property[self::PROPERTY_NAME], $arProperties)) {
                    $this->classString .= " * @property " . $property[self::PROPERTY_TYPE] . " $" . $property[self::PROPERTY_NAME] . "\n";
                    $arProperties[] = $property[self::PROPERTY_NAME];
                }
            }
            $this->classString .= " */\n";
        }
    }

    protected function addInClass()
    {
        // TODO: Implement addInClass() method.
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
        self::$searchClassString .= "    /**\n";
        self::$searchClassString .= "     * @inheritdoc\n";
        self::$searchClassString .= "     */\n";
        self::$searchClassString .= "    public function rules()\n";
        self::$searchClassString .= "    {\n";
        self::$searchClassString .= "         return [\n";
        if(isset(self::$params[self::PROPERTIES_VALIDATION_RULES])) {
            foreach (self::$params[self::PROPERTIES_VALIDATION_RULES] as $rule) {
                $ruleClass = $rule[self::CLASS_NAME];
                self::$searchClassString .= $ruleClass::getRuleString(self::$params);
            }
        }
        self::$searchClassString .= "         ];\n";
        self::$searchClassString .= "    }\n\n";
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
        self::$searchClassString .= "    /**\n";
        self::$searchClassString .= "     * @inheritdoc\n";
        self::$searchClassString .= "     */\n";
        self::$searchClassString .= "    public function scenarios()\n";
        self::$searchClassString .= "    {\n";
        self::$searchClassString .= "         return Model::scenarios();\n";
        self::$searchClassString .= "    }\n\n";
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
        self::$searchClassString .= "    /**\n";
        self::$searchClassString .= "     * Creates data provider instance with search query applied\n";
        self::$searchClassString .= "     *\n";
        self::$searchClassString .= "     * @param array \$params\n";
        self::$searchClassString .= "     *\n";
        self::$searchClassString .= "     * @return ActiveDataProvider\n";
        self::$searchClassString .= "     */\n";
        self::$searchClassString .= "    public function search(\$params)\n";
        self::$searchClassString .= "    {\n";
        self::$searchClassString .= "         \$query = ".self::$params[self::CLASS_NAME]."::find();\n";
        self::$searchClassString .= "         \n";
        self::$searchClassString .= "         \$dataProvider = new ActiveDataProvider([\n";
        self::$searchClassString .= "             'query' => \$query,\n";
        self::$searchClassString .= "         ]);\n";
        self::$searchClassString .= "         \n";
        self::$searchClassString .= "         \$this->load(\$params);\n";
        self::$searchClassString .= "         \n";
        self::$searchClassString .= "         if (!\$this->validate()) {\n";
        self::$searchClassString .= "             return \$dataProvider;\n";
        self::$searchClassString .= "         }\n";
        self::$searchClassString .= "         \n";
        self::$searchClassString .= "         \$query->andFilterWhere([\n";
        foreach(self::$params[self::PROPERTIES] as $property) {
            if(isset($property[self::PROPERTY_TYPE]) && $property[self::PROPERTY_TYPE] == 'integer') {
                self::$searchClassString .= "             '" . $property[self::PROPERTY_NAME] . "' => \$this->" . $property[self::PROPERTY_NAME] . ",\n";
            }
        }
        self::$searchClassString .= "         ]);\n";
        self::$searchClassString .= "         \n";
        self::$searchClassString .= "         \$query\n";
        foreach(self::$params[self::PROPERTIES] as $property) {
            if (isset($property[self::PROPERTY_TYPE]) && $property[self::PROPERTY_TYPE] == 'string') {
                self::$searchClassString .= "           ->andFilterWhere(['like', '" . $property[self::PROPERTY_NAME] . "', \$this->" . $property[self::PROPERTY_NAME] . "])\n";
            }
        }
        self::$searchClassString .= "         ;\n";
        self::$searchClassString .= "         \n";
        self::$searchClassString .= "         return \$dataProvider;\n";
        self::$searchClassString .= "    }\n\n";
    }
}