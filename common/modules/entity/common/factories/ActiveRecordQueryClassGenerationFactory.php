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

class ActiveRecordQueryClassGenerationFactory
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
    const ACTIVE_RECORD_MODE = 'ACTIVE_RECORD_QUERY_MODE';
    const RELATIONS = 'RELATIONS';
    const RELATION_METHOD_NAME = 'RELATION_METHOD_NAME';
    const RELATION_TYPE = 'RELATION_TYPE';
    const RELATION_FOREIGN_KEY = 'RELATION_FOREIGN_KEY';
    const RELATION_TARGET_KEY = 'RELATION_TARGET_KEY';
    const RELATION_TARGET_CLASS = 'RELATION_TARGET_CLASS';
    const RELATION_TABLE_NAME = 'RELATION_TABLE_NAME';

    protected static $params;
    protected static $classString;
    protected static $rules;



    public static function getClassString($params)
    {
        $params[self::RENDER_MODE] = self::ACTIVE_RECORD_MODE;
        self::$params = $params;
        self::render();

        return self::$classString;
    }

    public static function generateClassFile($params)
    {
        $params[self::RENDER_MODE] = self::ACTIVE_RECORD_MODE;
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
        self::rAllOne();
        self::rPropertyMethods();
        self::rRelationMethods();
        self::rClassEnd();
    }

    protected static function rHeader()
    {
        self::$classString .= "<?php\n";
        self::$classString .= "/**\n";
        self::$classString .= "* Created by ActiveRecordQueryClassGenerationFactory.\n";
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
        self::$classString .= "use yii\\db\\ActiveQuery;\n\n";
    }

    protected static function rClassBegin()
    {
        $arProperties = [];
        self::$classString .= "/**\n";
        self::$classString .= " * This is the ActiveQuery class for [[".self::$params[self::CLASS_NAME]."]].\n";
        self::$classString .= " *\n";
        self::$classString .= " * @see SmiReestr\n";
        self::$classString .= " */\n";
        self::$classString .= "class ".self::$params[self::CLASS_NAME]."Query extends ActiveQuery\n{\n";
    }

    protected static function rClassEnd()
    {
        self::$classString .= "}";
    }

    /**
     * @inheritdoc
     * @return SmiReestr[]|array
     *
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiReestr|array|null
     *
    public function one($db = null)
    {
        return parent::one($db);
    }*/

    protected static function rAllOne()
    {
        self::$classString .= "    /**\n";
        self::$classString .= "     * @inheritdoc\n";
        self::$classString .= "     * @return ".self::$params[self::CLASS_NAME]."[]|array\n";
        self::$classString .= "     */\n";
        self::$classString .= "    public function all(\$db = null)\n";
        self::$classString .= "    {\n";
        self::$classString .= "         return parent::all(\$db);\n";
        self::$classString .= "    }\n\n";

        self::$classString .= "    /**\n";
        self::$classString .= "     * @inheritdoc\n";
        self::$classString .= "     * @return ".self::$params[self::CLASS_NAME]."[]|array|null\n";
        self::$classString .= "     */\n";
        self::$classString .= "    public function one(\$db = null)\n";
        self::$classString .= "    {\n";
        self::$classString .= "         return parent::one(\$db);\n";
        self::$classString .= "    }\n\n";
    }

    /*
    public function type($type)
    {
        $this->andWhere(['type_id' => $type->id]);
        return $this;
    }

    public function type_id($type_id)
    {
        $this->andWhere(['type_id' => $type_id]);
        return $this;
    }*/

    protected static function rPropertyMethods()
    {
        if (isset(self::$params[self::PROPERTIES])) {
            foreach (self::$params[self::PROPERTIES] as $property) {
                self::$classString .= "    /**\n";
                self::$classString .= "     * @return \\yii\\db\\ActiveQuery.\n";
                self::$classString .= "     */\n";
                self::$classString .= "    public function " . $property[self::PROPERTY_NAME] . "($" . $property[self::PROPERTY_NAME] . ")\n";
                self::$classString .= "    {\n";
                self::$classString .= "         \$this->andWhere(['" . $property[self::PROPERTY_NAME] . "' => $" . $property[self::PROPERTY_NAME] . "]);\n";
                self::$classString .= "         return \$this;\n";
                self::$classString .= "    }\n\n";
            }
        }
    }

    /*
    public function specialization($specialization)
    {
        $this->joinWith('smiSpecialization')
            ->andWhere(['`smi_specialization`.`id`' => $specialization->id]);
        return $this;
    }*/

    protected static function rRelationMethods()
    {
        if(isset(self::$params[self::RELATIONS]) && !empty(self::$params[self::RELATIONS])) {
            foreach (self::$params[self::RELATIONS] as $relation) {
                self::$classString .= "    /**\n";
                self::$classString .= "     * @return \\yii\\db\\ActiveQuery.\n";
                self::$classString .= "     */\n";
                self::$classString .= "    public function " . $relation[self::RELATION_METHOD_NAME] . "($" . $relation[self::RELATION_METHOD_NAME] . ")\n";
                self::$classString .= "    {\n";
                self::$classString .= "         \$this->joinWith('" . $relation[self::RELATION_METHOD_NAME] . "')\n";
                self::$classString .= "             ->andWhere(['`" . $relation[self::RELATION_TABLE_NAME] . "`.`id`' => $" . $relation[self::RELATION_METHOD_NAME] . "->id]);\n";
                self::$classString .= "         return \$this;\n";
                self::$classString .= "    }\n\n";
            }
        }
    }

    protected static function makeClassFile()
    {
        $result = file_put_contents(self::$params[self::CLASS_FILE_LOCATION_PATH].self::$params[self::CLASS_NAME]."Query.php",self::$classString);
        if(!empty($result)){
            return true;
        }

        return false;
    }
}