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

class ActiveRecordSearchClassFactory
{
    const NAME_SPACE = 'NAME_SPACE';
    const CLASS_NAME = 'CLASS_NAME';
    const DATABASE_NAME = 'DATABASE_NAME';
    const TABLE_NAME = 'TABLE_NAME';
    const PROPERTIES = 'PROPERTIES';
    const PROPERTY_NAME = 'PROPERTY_NAME';
    const PROPERTY_TYPE = 'PROPERTY_TYPE';
    const PROPERTY_VALIDATION_RULES = 'PROPERTY_VALIDATION_RULES';
    const PROPERTY_VALIDATION_RULE_TYPE = 'PROPERTY_VALIDATION_RULE_TYPE';
    const PROPERTY_RELATION = 'PROPERTY_RELATION';
    const PROPERTY_RELATION_METHOD_NAME = 'PROPERTY_RELATION_METHOD_NAME';
    const PROPERTY_RELATION_TYPE = 'PROPERTY_RELATION_TYPE';
    const RELATION_TYPE_HAS_MANY = 'hasMany';
    const RELATION_TYPE_HAS_ONE = 'hasOne';
    const PROPERTY_RELATION_FOREIGN_KEY = 'PROPERTY_RELATION_FOREIGN_KEY';
    const PROPERTY_RELATION_TARGET_KEY = 'PROPERTY_RELATION_TARGET_KEY';
    const PROPERTY_RELATION_TARGET_CLASS = 'PROPERTY_RELATION_TARGET_CLASS';
    const AUTHOR_NAME = 'AUTHOR_NAME';
    const PROPERTY_LABEL = 'PROPERTY_LABEL';
    const I18N_MESSAGE_FILE_ALIAS = 'I18N_MESSAGE_FILE_ALIAS';
    const ACTIVE_QUERY_CLASS_NAME = 'ACTIVE_QUERY_CLASS_NAME';
    const CLASS_FILE_LOCATION_PATH = 'CLASS_FILE_LOCATION_PATH';
    const PROPERTIES_VALIDATION_RULES = 'PROPERTIES_VALIDATION_RULES';
    const RENDER_MODE = 'RENDER_MODE';
    const ACTIVE_RECORD_SEARCH_MODE = 'ACTIVE_RECORD_SEARCH_MODE';

    protected static $params;
    protected static $searchClassString;
    protected static $searchRules;



    public static function getClassString($params)
    {
        $params[self::RENDER_MODE] = self::ACTIVE_RECORD_SEARCH_MODE;
        self::$params = $params;
        self::render();

        return self::$searchClassString;
    }

    public static function generateClassFile($params)
    {
        $params[self::RENDER_MODE] = self::ACTIVE_RECORD_SEARCH_MODE;
        self::$params = $params;
        self::render();

        return self::makeClassFile();
    }

    protected static function render()
    {
        self::rHeader();
        self::rNamespace();
        self::rUses();
        self::rClassBegin();
        self::rRules();
        self::rScenarios();
        self::rSearch();
        self::rClassEnd();
    }

    protected static function rHeader()
    {
        self::$searchClassString .= "<?php\n";
        self::$searchClassString .= "/**\n";
        self::$searchClassString .= "* Created by ActiveRecordSearchClassFactory.\n";
        self::$searchClassString .= "* Author: ".self::$params[self::AUTHOR_NAME]."\n";
        self::$searchClassString .= "* Date: ".date("d.m.Y")."\n";
        self::$searchClassString .= "* Time: ".date("h:i:sa")."\n";
        self::$searchClassString .= "*/\n\n";
    }

    protected static function rNamespace()
    {
        self::$searchClassString .= "namespace ".self::$params[self::NAME_SPACE].";\n\n";
    }

    protected static function rUses()
    {
        self::$searchClassString .= "use Yii;\n";
        self::$searchClassString .= "use yii\\base\\Model;\n";
        self::$searchClassString .= "use yii\\data\\ActiveDataProvider;\n";
        self::$searchClassString .= "use ".self::$params[self::NAME_SPACE]."\\".self::$params[self::CLASS_NAME].";\n\n";
    }

    protected static function rClassBegin()
    {
        self::$searchClassString .= "/**\n";
        self::$searchClassString .= " * ".self::$params[self::CLASS_NAME]."Search represents the model behind the search form about `".self::$params[self::NAME_SPACE]."\\".self::$params[self::CLASS_NAME]."`..\n";
        self::$searchClassString .= " */\n";
        self::$searchClassString .= "class ".self::$params[self::CLASS_NAME]."Search extends ".self::$params[self::CLASS_NAME]."\n{\n";
    }

    protected static function rClassEnd()
    {
        self::$searchClassString .= "}";
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

    protected static function rRules()
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

    protected static function rScenarios()
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
     */
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
    }

    protected static function rSearch()
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

    protected static function makeClassFile()
    {
        $result = file_put_contents(self::$params[self::CLASS_FILE_LOCATION_PATH].self::$params[self::CLASS_NAME]."Search.php",self::$searchClassString);
        if(!empty($result)){
            return true;
        }

        return false;
    }
}