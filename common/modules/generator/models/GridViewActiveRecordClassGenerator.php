<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 23.09.2015
 * Time: 12:03
 */
namespace common\modules\generator\models;

use common\helpers\DebugHelper;
use Yii;

class GridViewActiveRecordClassGenerator extends AbstractClassGenerator
{
    const RENDER_MODE_VALUE = 'ACTIVE_RECORD_SEARCH_MODE';

    public function __construct($params)
    {
        $arParams = $params;
        $arParams[self::USED_CLASSES] = [
            'Yii',
            'yii\\db\\ActiveRecord',
            'yii\\data\\ActiveDataProvider',
//            'yii\\grid\\GridView',
            'kartik\\grid\\GridView',
            'yii\\helpers\\Html',
            'yii\\helpers\\ArrayHelper',
            'common\\modules\\entity\\common\\factories\\EntityTypeClassFactory',
        ];
        $arParams[self::EXTEND_CLASS_NAME] = 'ActiveRecord';
        $arParams[self::CLASS_NAME] = $params[self::CLASS_NAME];
        parent::__construct($arParams);
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
        $this->addPropertyInitialisation();
        $this->addGetInstance();
        $this->addTableName();
        $this->addGetDb();
        $this->addRules();
        $this->addAttributeLabels();
        $this->addSearch();
        $this->addGetColumns();
        $this->addRender();
        $this->addRelationMethods();
//        $this->addFind();
    }

    /*public $title;
    public $language_id;
    public $language;*/

    protected function addPropertyInitialisation()
    {
        $this->classString .= "    public static \$instance;\n";
        foreach($this->params[self::PROPERTIES] as $property) {
            if($this->hasJoins($property[self::ENTITY_TYPE_NAME])) {
                $this->classString .= "    public $" . $property[self::PROPERTY_NAME] . ";\n";
            }
        }
        $this->classString .= "    \n";
    }

    /*public static function getInstance()
    {
        if(empty(static::instance)) {
            $className = self::className();
            static::instance = new $className;
        }

        return static::instance;
    }*/

    protected function addGetInstance()
    {
        $this->classString .= "    /**\n";
        $this->classString .= "     * @inheritdoc\n";
        $this->classString .= "     */\n";
        $this->classString .= "    public static function getInstance()\n";
        $this->classString .= "    {\n";
        $this->classString .= "         if(empty(static::\$instance)) {\n";
        $this->classString .= "             \$className = self::className();\n";
        $this->classString .= "             static::\$instance = new \$className;\n";
        $this->classString .= "         }\n";
        $this->classString .= "         return static::\$instance;\n";
        $this->classString .= "    }\n\n";
    }

    /**
     * @inheritdoc
     *
    public static function tableName()
    {
        return 'tableName';
    }*/

    protected function addTableName()
    {
        if(isset($this->params[self::TABLE_NAME])) {
            $this->classString .= "    /**\n";
            $this->classString .= "     * @inheritdoc\n";
            $this->classString .= "     */\n";
            $this->classString .= "    public static function tableName()\n";
            $this->classString .= "    {\n";
            $this->classString .= "         return '" . $this->params[self::TABLE_NAME] . "';\n";
            $this->classString .= "    }\n\n";
        }
    }

    /**
     * Returns the database connection used by this AR class.
     * I override this method to use a data sets database connection.
     * @return Connection the database connection used by this AR class.
     *
    public static function getDb()
    {
        return Yii::$app->db;
    }*/

    protected function addGetDb()
    {
        if(isset($this->params[self::DATABASE_NAME])) {
            $this->classString .= "    /**\n";
            $this->classString .= "     * @inheritdoc\n";
            $this->classString .= "     */\n";
            $this->classString .= "    public static function getDb()\n";
            $this->classString .= "    {\n";
            $this->classString .= "         return Yii::\$app->" . $this->params[self::DATABASE_NAME] . ";\n";
            $this->classString .= "    }\n\n";
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
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'region_id' => Yii::t('app', 'Регион'),
            'title' => Yii::t('app', 'Наименования'),
            'order' => Yii::t('app', 'Порядка'),
        ];
    }*/

    protected function addAttributeLabels()
    {
        $this->classString .= "    /**\n";
        $this->classString .= "     * @inheritdoc\n";
        $this->classString .= "     */\n";
        $this->classString .= "    public function attributeLabels()\n";
        $this->classString .= "    {\n";
        $this->classString .= "         return [\n";
        if(isset($this->params[self::PROPERTIES])) {
            foreach ($this->params[self::PROPERTIES] as $property) {
                if (isset($this->params[self::I18N_MESSAGE_FILE_ALIAS])) {
                    $this->classString .= "             '" . $property[self::PROPERTY_NAME] . "' => Yii::t('" . $this->params[self::I18N_MESSAGE_FILE_ALIAS] . "', '" . $property[self::PROPERTY_LABEL] . "'),\n";
                } else {
                    $this->classString .= "             '" . $property[self::PROPERTY_NAME] . "' => '" . $property[self::PROPERTY_LABEL] . "',\n";
                }
            }
        }
        $this->classString .= "         ];\n";
        $this->classString .= "    }\n\n";
    }

    /**
     * @inheritdoc
     * @return CitiesQuery the active query used by this AR class.
     *
    public static function find()
    {
        return new CitiesQuery(get_called_class());
    }*/

    protected function addFind()
    {
        if(isset($this->params[self::ACTIVE_QUERY_CLASS_NAME])) {
            $this->classString .= "    /**\n";
            $this->classString .= "     * @inheritdoc\n";
            $this->classString .= "     * @return ".$this->params[self::ACTIVE_QUERY_CLASS_NAME]." the active query used by this AR class.\n";
            $this->classString .= "     */\n";
            $this->classString .= "    public static function find()\n";
            $this->classString .= "    {\n";
            $this->classString .= "         return new ".$this->params[self::ACTIVE_QUERY_CLASS_NAME]."(get_called_class());\n";
            $this->classString .= "    }\n\n";
        }
    }



    protected function addRelationMethods()
    {

        if(isset($this->params[self::RELATIONS]) && !empty($this->params[self::RELATIONS])) {
            foreach ($this->params[self::RELATIONS] as $relation) {
                $this->classString .= "    /**\n";
                $this->classString .= "     * @return \\yii\\db\\ActiveQuery.\n";
                $this->classString .= "     */\n";
                $this->classString .= "    public function get" . $relation[self::RELATION_METHOD_NAME] . "()\n";
                $this->classString .= "    {\n";
                $this->classString .= "         if(!class_exists('" . $relation[self::RELATION_TARGET_CLASS] . "')) {\n";
                $this->classString .= "             EntityTypeClassFactory::get(" . $relation[self::ENTITY_TYPE_ID] . ");\n";
                $this->classString .= "         }\n";
                $this->classString .= "         return \$this->" . $relation[self::RELATION_TYPE] . "(" . $relation[self::RELATION_TARGET_CLASS] . "::className(),['" . $relation[self::RELATION_TARGET_KEY] . "' => '" . $relation[self::RELATION_FOREIGN_KEY] . "']);\n";
                $this->classString .= "    }\n\n";

                $this->classString .= "    /**\n";
                $this->classString .= "     * @return array ['key' => 'value'].\n";
                $this->classString .= "     */\n";
                $this->classString .= "    public function get" . $relation[self::RELATION_METHOD_NAME] . "s()\n";
                $this->classString .= "    {\n";
                $this->classString .= "         if(!class_exists('" . $relation[self::RELATION_TARGET_CLASS] . "')) {\n";
                $this->classString .= "             EntityTypeClassFactory::get(" . $relation[self::ENTITY_TYPE_ID] . ");\n";
                $this->classString .= "         }\n";
                $this->classString .= "         return ArrayHelper::map(" . $relation[self::RELATION_TARGET_CLASS] . "::find()->all(),'".$relation[self::DICTIONARY_KEY_FIELD_NAME]."','".$relation[self::DICTIONARY_VALUE_FIELD_NAME]."');\n";
                $this->classString .= "    }\n\n";
            }
        }
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     *
    public function search($params, $pageSize = null)
    {
        $arDataProvider = [];
        $query = EntityFields::find();
        $arDataProvider['query'] = $query;
        if($pageSize != null) $arDataProvider['pagination'] = ['pageSize' => $pageSize];

        $dataProvider = new ActiveDataProvider($arDataProvider);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->select([
            'tasks_cart.id as id',
            'smi_registration_appeals_reest.smiTitle as title',
            'smi_registration_appeals_reest_languages.language_id as language_id',
            'languages.title as language',
        ]);

        $query->leftJoin('smi_registration_appeals_reest','smi_registration_appeals_reest.task_id = tasks_cart.id');
        $query->leftJoin('smi_registration_appeals_reest_languages','smi_registration_appeals_reest_languages.smiId = smi_registration_appeals_reest.id');
        $query->leftJoin('languages','languages.id = smi_registration_appeals_reest_languages.language_id');

        $query->andFilterWhere([
            'id' => $this->id,
            'process_id' => $this->process_id,
            'author_id' => Yii::$app->user->id,
            'current_node_id' => $this->current_node_id,
            'created_at' => $this->created_at,
            'languages.id' => $this->language_id
        ]);

        $query->andFilterWhere(['like', 'smi_registration_appeals_reest.smiTitle', $this->title]);

        $query->orderBy('id desc');

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
        $this->classString .= "    public function search(\$params, \$pageSize = null)\n";
        $this->classString .= "    {\n";
        $this->classString .= "         \$arDataProvider = [];\n";
        $this->classString .= "         \$query = static::find();\n";
        $this->classString .= "         \$arDataProvider['query'] = \$query;\n";
        $this->classString .= "         if(!empty(\$pageSize)) \$arDataProvider['pagination'] = ['pageSize' => \$pageSize];\n";
        $this->classString .= "         \n";
        $this->classString .= "         \$dataProvider = new ActiveDataProvider(\$arDataProvider);\n";
        $this->classString .= "         \n";
        $this->classString .= "         \$this->load(\$params);\n";
        $this->classString .= "         \n";
        $this->classString .= "         if (!\$this->validate()) {\n";
        $this->classString .= "             return \$dataProvider;\n";
        $this->classString .= "         }\n";
        $this->classString .= "         \n";
        $this->classString .= "         \$query->select([\n";
        foreach($this->params[self::PROPERTIES] as $property) {
            $this->classString .= "             '" .$property[self::ENTITY_TYPE_NAME].".".$property[self::PROPERTY_NAME] . " as ".$property[self::PROPERTY_NAME]."',\n";
        }
        $this->classString .= "         ]);\n";
        $this->classString .= "         \n";
        foreach($this->params[self::SELECTED_ENTITY_TYPES] as $entityType) {
            if(isset($entityType[self::ENTITY_TYPE_JOINS]) && !empty($entityType[self::ENTITY_TYPE_JOINS])) {
                foreach($entityType[self::ENTITY_TYPE_JOINS] as $join) {
                    $this->classString .= "          \$query->leftJoin('".$entityType[self::ENTITY_TYPE_NAME]."','".$entityType[self::ENTITY_TYPE_NAME].".".$join[self::PROPERTY_NAME]." = ".$join[self::DICTIONARY_NAME].".".$join[self::DICTIONARY_KEY_FIELD_NAME]."');\n";
                }
            }
        }
        $this->classString .= "         \n";
        $this->classString .= "         \$query->andFilterWhere([\n";
        foreach($this->params[self::PROPERTIES] as $property) {
            if(isset($property[self::PROPERTY_TYPE]) && $property[self::PROPERTY_TYPE] == 'integer') {
                $this->classString .= "             '" .$property[self::ENTITY_TYPE_NAME].".".$property[self::PROPERTY_NAME] . "' => \$this->" . $property[self::PROPERTY_NAME] . ",\n";
            }
        }
        $this->classString .= "         ]);\n";
        $this->classString .= "         \n";
        if($this->hasStringPropertyType()) {
            $this->classString .= "         \$query\n";
            foreach ($this->params[self::PROPERTIES] as $property) {
                if (isset($property[self::PROPERTY_TYPE]) && $property[self::PROPERTY_TYPE] == 'string') {
                    $this->classString .= "           ->andFilterWhere(['like', '" .$property[self::ENTITY_TYPE_NAME].".". $property[self::PROPERTY_NAME] . "', \$this->" . $property[self::PROPERTY_NAME] . "])\n";
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

    /*public function getColumns()
    {
        return [
            'id',
            'process_id',
            'author_id',
            'current_node_id',
            'created_at',
            'languages.id',
        ];
    }*/

    protected function addGetColumns()
    {
        $this->classString .= "    public function getColumns()\n";
        $this->classString .= "    {\n";
        $this->classString .= "         \$instance = self::getInstance();\n";
        $this->classString .= "         return [\n";
        foreach($this->params[self::PROPERTIES] as $property) {
            if(isset($property[self::DICTIONARY_NAME])){
                $this->classString .= "             [\n";
                $this->classString .= "                 'attribute' => '" . $property[self::PROPERTY_NAME] . "',\n";
                $this->classString .= "                 'filter' => Html::activeDropDownList(\n";
                $this->classString .= "                     \$instance,\n";
                $this->classString .= "                     '" . $property[self::PROPERTY_NAME] . "',\n";
                $this->classString .= "                     \$instance->" . $property[self::RELATION] . "s,\n";
                $this->classString .= "                     [\n";
                $this->classString .= "                         'prompt' => ' -- Выберите --',\n";
                $this->classString .= "                         'class' => 'form-control',\n";
                $this->classString .= "                         'style' => 'width: 100%;'\n";
                $this->classString .= "                     ]\n";
                $this->classString .= "                 ),\n";
                $this->classString .= "                 'value' => function(\$model){\n";
//                $this->classString .= "                     return !empty(\$model->" . $property[self::RELATION] . ")?\$model->" . $property[self::RELATION] . "->".$property[self::DICTIONARY_VALUE_FIELD_NAME].":'Нет';\n";
                $this->classString .= "                     return !empty(\$model->" . $property[self::RELATION] . ")?\$model->" . $property[self::RELATION] . "->".$property[self::DICTIONARY_VALUE_FIELD_NAME].":'Нет';\n";
                $this->classString .= "                 },\n";
                $this->classString .= "             ],\n";
            }else {
                $this->classString .= "             '" . $property[self::PROPERTY_NAME] . "',\n";
            }
        }
        $this->classString .= "         ];\n";
        $this->classString .= "    }\n\n";
    }

    /*public function getSomeFilter()
    {
        return Html::activeDropDownList(
            $gridView,
            'language_id',
            ArrayHelper::map($gridView->languages::find()->all(),'id','title'),
            [
                'prompt' => ' -- Выберите --',
                'class' => 'form-control',
                'style'=>'width: 100%;'
            ]
        );
    }*/

    /*public static function render()
    {
        $className = self::className();
        $gridView = new $className;
        return GridView::widget([
            'dataProvider' => $gridView->search(Yii::$app->request->queryParams),
            'filterModel' => $gridView,
            'columns' => $gridView->columns,
        ]);
    }*/

    protected function addRender()
    {
        $this->classString .= "    public static function render()\n";
        $this->classString .= "    {\n";
//        $this->classString .= "         \$className = self::className();\n";
//        $this->classString .= "         \$gridView = \$className::getInstance();\n";
        $this->classString .= "         \$gridView = static::getInstance();\n";
        $this->classString .= "         if(!empty(\$gridView->columns)){\n";
        $this->classString .= "             return GridView::widget([\n";
        $this->classString .= "                 'dataProvider' => \$gridView->search(Yii::\$app->request->queryParams),\n";
        $this->classString .= "                 'filterModel' => \$gridView,\n";
        $this->classString .= "                 'columns' => \$gridView->columns,\n";
        $this->classString .= "             ]);\n";
        $this->classString .= "         }\n";
        $this->classString .= "         return false;\n";
        $this->classString .= "    }\n\n";
    }

    /*protected function addRender()
    {
        $this->classString .= "    public function render()\n";
        $this->classString .= "    {\n";
        $this->classString .= "         return GridView::widget([\n";
        $this->classString .= "             'dataProvider' => \$this->search(Yii::\$app->request->queryParams),\n";
        $this->classString .= "             'filterModel' => \$this,\n";
        $this->classString .= "             'columns' => \$this->columns,\n";
        $this->classString .= "         ]);\n";
        $this->classString .= "    }\n\n";
    }*/

    protected function hasJoins($entityTypeName)
    {
        foreach($this->params[self::SELECTED_ENTITY_TYPES] as $entityType) {
            if($entityType[self::ENTITY_TYPE_NAME] ==  $entityTypeName && isset($entityType[self::ENTITY_TYPE_JOINS])){
                return true;
            }
        }

        return false;
    }
}