<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 23.09.2015
 * Time: 12:03
 */
namespace common\modules\entity\common\factories;

use common\modules\entity\common\models\User;
use Yii;

class BehaviorClassFactory
{
    const NAME_SPACE = 'NAME_SPACE';
    const CLASS_NAME = 'CLASS_NAME';
    const PROPERTIES = 'PROPERTIES';
    const PROPERTY_NAME = 'PROPERTY_NAME';

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
        self::rProperties();
        self::rMethods();
        self::rJoinMethods();
        self::rClassEnd();
    }

    protected static function rHeader()
    {
        $user = User::findOne(Yii::$app->user->id);
        $username = !empty($user)?$user->username:"Avazbek Niyazov";

        self::$classString .= "<?php\n";
        self::$classString .= "/**\n";
        self::$classString .= "* Created by BehaviorClassFactory.\n";
        self::$classString .= "* User: ".$username."\n";
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
        self::$classString .= "use yii\\base\\Behavior;\n\n";
    }

    protected static function rClassBegin()
    {
        self::$classString .= "class ".self::$params[self::CLASS_NAME]."Behavior extends Behavior\n{\n";
    }

    protected static function rClassEnd()
    {
        self::$classString .= "}";
    }

    protected static function rProperties()
    {
        foreach(self::$params[self::PROPERTIES] as $property) {
            self::$classString .= "    public $"."_".$property[self::PROPERTY_NAME].";\n\n";
        }
    }

    protected static function rMethods()
    {
        foreach(self::$params[self::PROPERTIES] as $property) {
            self::$classString .= "    public function get".self::getPropertyName($property[self::PROPERTY_NAME])."()\n";
            self::$classString .= "    {\n";
            self::$classString .= "         return $"."this->_".$property[self::PROPERTY_NAME].";\n";
            self::$classString .= "    }\n\n";

            self::$classString .= "    public function set".self::getPropertyName($property[self::PROPERTY_NAME])."($"."value)\n";
            self::$classString .= "    {\n";
            self::$classString .= "         $"."this->_".$property[self::PROPERTY_NAME]." = $"."value;\n";
            self::$classString .= "    }\n\n";
        }
    }

    protected static function rJoinMethods()
    {
        self::$classString .= "    public function join".self::$params[self::CLASS_NAME]."($"."query)\n";
        self::$classString .= "    {\n";
        self::$classString .= "         $"."query->joinWith('".self::$params[self::CLASS_NAME]."');\n";
        self::$classString .= "    }\n\n";
    }

    private static function getPropertyName($propertyName)
    {
        $name = '';
        $arName = explode("_",$propertyName);
        foreach($arName as $nameItem){
            $name .= ucfirst($nameItem);
        }

        return $name;
    }


}