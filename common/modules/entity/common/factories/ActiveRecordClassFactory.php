<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 23.09.2015
 * Time: 12:03
 */
namespace common\modules\entity\common\factories;

use Yii;

class ActiveRecordClassFactory
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

    protected static $params;
    protected static $classString;
    protected static $rules;



    public static function getClassString($params)
    {
        self::$params = $params;
        self::render();

        return self::$classString;
    }

    public static function generateClassFile($params)
    {
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
        self::rTableName();
        self::rGetDb();
        self::rRules();
        self::rAttributeLabels();
        self::rRelationMethods();
        //self::rFind();
        self::rClassEnd();
    }

    protected static function rHeader()
    {
        self::$classString .= "<?php\n";
        self::$classString .= "/**\n";
        self::$classString .= "* Created by ActiveRecordClassFactory.\n";
        self::$classString .= "* Author: ".self::$params[self::AUTHOR_NAME]."\n";
        self::$classString .= "* Date: ".date("d.m.Y")."\n";
        self::$classString .= "* Time: ".date("h:i:sa")."\n";
        self::$classString .= "*/\n\n";
    }

    protected static function rNamespace()
    {
        self::$classString .= "namespace ".self::$params[self::NAME_SPACE].";\n\n";
    }

    protected static function rUses()
    {
        self::$classString .= "use Yii;\n\n";
        self::$classString .= "use yii\\db\\ActiveRecord;\n\n";
    }

    protected static function rClassBegin()
    {
        $arProperties = [];
        self::$classString .= "/**\n";
        self::$classString .= " * This is the model class for table \"".self::$params[self::TABLE_NAME]."\".\n";
        self::$classString .= " *\n";
        foreach(self::$params[self::PROPERTIES] as $property) {
            if(!in_array($property[self::PROPERTY_NAME], $arProperties)) {
                self::$classString .= " * @property " . $property[self::PROPERTY_TYPE] . " $" . $property[self::PROPERTY_NAME] . "\n";
                $arProperties[] = $property[self::PROPERTY_NAME];
            }
        }
        self::$classString .= " */\n";
        self::$classString .= "class ".self::$params[self::CLASS_NAME]." extends ActiveRecord\n{\n";
    }

    protected static function rClassEnd()
    {
        self::$classString .= "}";
    }

    /**
     * @inheritdoc
     *
    public static function tableName()
    {
        return 'cities';
    }*/

    protected static function rTableName()
    {
        self::$classString .= "    /**\n";
        self::$classString .= "     * @inheritdoc\n";
        self::$classString .= "     */\n";
        self::$classString .= "    public static function tableName()\n";
        self::$classString .= "    {\n";
        self::$classString .= "         return '".self::$params[self::TABLE_NAME]."';\n";
        self::$classString .= "    }\n\n";
    }

    /**
     * Returns the database connection used by this AR class.
     * I override this method to use a data sets database connection.
     * @return Connection the database connection used by this AR class.
     *
    public static function getDb()
    {
        return Yii::$app->pdb;
    }*/

    protected static function rGetDb()
    {
        self::$classString .= "    /**\n";
        self::$classString .= "     * @inheritdoc\n";
        self::$classString .= "     */\n";
        self::$classString .= "    public static function getDb()\n";
        self::$classString .= "    {\n";
        self::$classString .= "         return Yii::\$app->".self::$params[self::DATABASE_NAME].";\n";
        self::$classString .= "    }\n\n";
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
        self::$classString .= "    /**\n";
        self::$classString .= "     * @inheritdoc\n";
        self::$classString .= "     */\n";
        self::$classString .= "    public function rules()\n";
        self::$classString .= "    {\n";
        self::$classString .= "         return [\n";
        if(isset(self::$params[self::PROPERTIES_VALIDATION_RULES])) {
            foreach (self::$params[self::PROPERTIES_VALIDATION_RULES] as $rule) {
                $ruleClass = $rule[self::CLASS_NAME];
                self::$classString .= $ruleClass::getRuleString(self::$params);
            }
        }
        self::$classString .= "         ];\n";
        self::$classString .= "    }\n\n";
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

    protected static function rAttributeLabels()
    {
        self::$classString .= "    /**\n";
        self::$classString .= "     * @inheritdoc\n";
        self::$classString .= "     */\n";
        self::$classString .= "    public function attributeLabels()\n";
        self::$classString .= "    {\n";
        self::$classString .= "         return [\n";
        foreach(self::$params[self::PROPERTIES] as $property) {
            if(isset(self::$params[self::I18N_MESSAGE_FILE_ALIAS])) {
                self::$classString .= "             '" . $property[self::PROPERTY_NAME] . "' => Yii::t('".self::$params[self::I18N_MESSAGE_FILE_ALIAS]."', '" . $property[self::PROPERTY_LABEL] . "'),\n";
            }else{
                self::$classString .= "             '" . $property[self::PROPERTY_NAME] . "' => '" . $property[self::PROPERTY_LABEL] . "',\n";
            }
        }
        self::$classString .= "         ];\n";
        self::$classString .= "    }\n\n";
    }

    /**
     * @inheritdoc
     * @return CitiesQuery the active query used by this AR class.
     *
    public static function find()
    {
        return new CitiesQuery(get_called_class());
    }*/

    protected static function rFind()
    {
        if(isset(self::$params[self::ACTIVE_QUERY_CLASS_NAME])) {
            self::$classString .= "    /**\n";
            self::$classString .= "     * @inheritdoc\n";
            self::$classString .= "     * @return ".self::$params[self::ACTIVE_QUERY_CLASS_NAME]." the active query used by this AR class.\n";
            self::$classString .= "     */\n";
            self::$classString .= "    public static function find()\n";
            self::$classString .= "    {\n";
            self::$classString .= "         return new ".self::$params[self::ACTIVE_QUERY_CLASS_NAME]."(get_called_class());\n";
            self::$classString .= "    }\n\n";
        }
    }

    protected static function rRelationMethods()
    {
        foreach(self::$params[self::PROPERTIES] as $property) {
            if(isset($property[self::PROPERTY_RELATION])) {
                $relation = $property[self::PROPERTY_RELATION];
                self::$classString .= "    /**\n";
                self::$classString .= "     * @return \\yii\\db\\ActiveQuery.\n";
                self::$classString .= "     */\n";
                self::$classString .= "    public function get" . $relation[self::PROPERTY_RELATION_METHOD_NAME] . "()\n";
                self::$classString .= "    {\n";
                self::$classString .= "         return $" . "this->" . $relation[self::PROPERTY_RELATION_TYPE] . "(" . $relation[self::PROPERTY_RELATION_TARGET_CLASS] . "::className(),['" . $relation[self::PROPERTY_RELATION_TARGET_KEY] . "' => '" . $relation[self::PROPERTY_RELATION_FOREIGN_KEY] . "']);\n";
                self::$classString .= "    }\n\n";
            }
        }
    }

    protected static function makeClassFile()
    {
        $result = file_put_contents(self::$params[self::CLASS_FILE_LOCATION_PATH].self::$params[self::CLASS_NAME].".php",self::$classString);
        if(!empty($result)){
            return true;
        }

        return false;
    }
}