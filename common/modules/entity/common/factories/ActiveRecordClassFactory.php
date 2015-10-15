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
    const TABLE_NAME = 'TABLE_NAME';
    const PROPERTIES = 'PROPERTIES';
    const PROPERTY_NAME = 'PROPERTY_NAME';
    const PROPERTY_TYPE = 'PROPERTY_TYPE';
    const AUTHOR_NAME = 'AUTHOR_NAME';

    protected static $params;
    protected static $classString;



    public static function getClassString($params)
    {
        self::$params = $params;
        self::render();

        return self::$classString;
    }

    protected static function render()
    {
        self::rHeader();
        self::rNamespace();
        self::rUses();
        self::rClassBegin();
        self::rTableName();
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
        self::$classString .= "use yii\\db\\ActiveRecord;\n\n";
    }

    protected static function rClassBegin()
    {
        self::$classString .= "/**\n";
        self::$classString .= " * This is the model class for table \"".self::$params[self::TABLE_NAME]."\".\n";
        self::$classString .= " *\n";
        foreach(self::$params[self::PROPERTIES] as $property) {
            self::$classString .= " * @property ".$property[self::PROPERTY_TYPE]." $".$property[self::PROPERTY_NAME]."\n";
        }
        self::$classString .= " */\n";
        self::$classString .= "class ".self::$params[self::CLASS_NAME]." extends ActiveRecord\n{\n";
    }

    protected static function rClassEnd()
    {
        self::$classString .= "}";
    }

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
}