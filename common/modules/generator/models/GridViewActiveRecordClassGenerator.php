<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 23.09.2015
 * Time: 12:03
 */
namespace common\modules\generator\models;

use Yii;

class GridViewActiveRecordClassGenerator extends AbstractClassGenerator
{
    const RENDER_MODE_VALUE = 'GRID_VIEW_ACTIVE_RECORD_MODE';

    public function __construct($params)
    {
        $arParams = $params;
        $arParams[self::USED_CLASSES] = [
            'Yii',
            'yii\\db\\ActiveRecord',
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
        $this->addTableName();
        $this->addGetDb();
        $this->addRules();
//        $this->addAttributeLabels();
//        $this->addRelationMethods();
//        $this->addGetSearch();
//        $this->addGetSearchByTaskId();
//        $this->addGetSearchModel();
//        $this->addFind();
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

    /**
     * @inheritdoc
     * @return CitiesQuery the active query used by this AR class.
     *
    public static function search()
    {
        $searchModel = new CitiesSearch();
        return $searchModel->search($this->attributes);
    }*/

    protected function addGetSearch()
    {
        if(isset($this->params[self::ACTIVE_QUERY_CLASS_NAME])) {
            $this->classString .= "    /**\n";
            $this->classString .= "     * @inheritdoc\n";
            $this->classString .= "     * @return ActiveDataProvider class object.\n";
            $this->classString .= "     */\n";
            $this->classString .= "    public function search(\$params = null, \$pageSize = null)\n";
            $this->classString .= "    {\n";
            $this->classString .= "         \$searchModel = new ".$this->params[self::CLASS_NAME]."Search;\n";
            $this->classString .= "         if(empty(\$params)){\n";
            $this->classString .= "             return \$searchModel->searchLink(\$this->attributes, \$pageSize);\n";
            $this->classString .= "         }else{\n";
            $this->classString .= "             return \$searchModel->search(\$params, \$pageSize);\n";
            $this->classString .= "         }\n";
            $this->classString .= "    }\n\n";
        }
    }

    /**
     * @inheritdoc
     * @return CitiesQuery the active query used by this AR class.
     *
    public static function search()
    {
    $searchModel = new CitiesSearch();
    return $searchModel->search($this->attributes);
    }*/

    protected function addGetSearchByTaskId()
    {
        if(isset($this->params[self::ACTIVE_QUERY_CLASS_NAME])) {
            $this->classString .= "    /**\n";
            $this->classString .= "     * @inheritdoc\n";
            $this->classString .= "     * @return ActiveDataProvider class object.\n";
            $this->classString .= "     */\n";
            $this->classString .= "    public function searchByTaskId(\$task_id, \$pageSize = null)\n";
            $this->classString .= "    {\n";
            $this->classString .= "         \$searchModel = new ".$this->params[self::CLASS_NAME]."Search;\n";
            $this->classString .= "         return \$searchModel->searchLink(['system_task_id' => \$task_id], \$pageSize);\n";
            $this->classString .= "    }\n\n";
        }
    }

    /**
     * @inheritdoc
     * @return CitiesQuery the active query used by this AR class.
     *
    public static function searchModel()
    {
        $searchModel = new CitiesSearch();
        return $searchModel->search($this->attributes);
    }*/

    protected function addGetSearchModel()
    {
        if(isset($this->params[self::ACTIVE_QUERY_CLASS_NAME])) {
            $this->classString .= "    /**\n";
            $this->classString .= "     * @inheritdoc\n";
            $this->classString .= "     * @return ".$this->params[self::CLASS_NAME]."Search class object.\n";
            $this->classString .= "     */\n";
            $this->classString .= "    public function searchModel()\n";
            $this->classString .= "    {\n";
            $this->classString .= "         \$searchModel = new ".$this->params[self::CLASS_NAME]."Search;\n";
            $this->classString .= "         return \$searchModel;\n";
            $this->classString .= "    }\n\n";
        }
    }

    protected function addRelationMethods()
    {
//        if(isset($this->params[self::PROPERTIES])) {
//            foreach ($this->params[self::PROPERTIES] as $property) {
//                if (isset($property[self::RELATION]) && !empty($property[self::RELATION])) {
//                    $relation = $property[self::RELATION];
//                    $this->classString .= "    /**\n";
//                    $this->classString .= "     * @return \\yii\\db\\ActiveQuery.\n";
//                    $this->classString .= "     */\n";
//                    $this->classString .= "    public function get" . $relation[self::RELATION_METHOD_NAME] . "()\n";
//                    $this->classString .= "    {\n";
//                    $this->classString .= "         return \$this->" . $relation[self::RELATION_TYPE] . "(" . $relation[self::RELATION_TARGET_CLASS] . "::className(),['" . $relation[self::RELATION_TARGET_KEY] . "' => '" . $relation[self::RELATION_FOREIGN_KEY] . "']);\n";
//                    $this->classString .= "    }\n\n";
//                }
//            }
//        }

        if(isset($this->params[self::RELATIONS]) && !empty($this->params[self::RELATIONS])) {
            foreach ($this->params[self::RELATIONS] as $relation) {
                $this->classString .= "    /**\n";
                $this->classString .= "     * @return \\yii\\db\\ActiveQuery.\n";
                $this->classString .= "     */\n";
                $this->classString .= "    public function get" . $relation[self::RELATION_METHOD_NAME] . "()\n";
                $this->classString .= "    {\n";
                $this->classString .= "         return \$this->" . $relation[self::RELATION_TYPE] . "(" . $relation[self::RELATION_TARGET_CLASS] . "::className(),['" . $relation[self::RELATION_TARGET_KEY] . "' => '" . $relation[self::RELATION_FOREIGN_KEY] . "']);\n";
                $this->classString .= "    }\n\n";
            }
        }
    }
}