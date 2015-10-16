<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 16.10.2015
 * Time: 18:45
 */
namespace common\modules\entity\common\factories;

class AbstractClassGenerationFactory
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
    const ACTIVE_RECORD_MODE = 'ACTIVE_RECORD_MODE';
    const RELATIONS = 'RELATIONS';
    const RELATION_METHOD_NAME = 'RELATION_METHOD_NAME';
    const RELATION_TYPE = 'RELATION_TYPE';
    const RELATION_FOREIGN_KEY = 'RELATION_FOREIGN_KEY';
    const RELATION_TARGET_KEY = 'RELATION_TARGET_KEY';
    const RELATION_TARGET_CLASS = 'RELATION_TARGET_CLASS';
    const RELATION_TABLE_NAME = 'RELATION_TABLE_NAME';

    protected static function getName($nameString)
    {
        $name = '';
        $arName = explode("_",$nameString);
        foreach($arName as $nameItem){
            $name .= ucfirst($nameItem);
        }

        return $name;
    }

    protected static function getMethodsName($nameString)
    {
        $replaceItems = ['id', 'Id', 'ID', '_id', '_Id', '_ID', '_id_', '_Id_', '_ID_',];

        foreach($replaceItems as $item) {
            $nameString = str_replace($item, '', $nameString);
        }

        $name = self::getName($nameString);

        return $name;
    }

    protected static function makeClassFile($additional = '')
    {
        $result = file_put_contents(self::$params[self::CLASS_FILE_LOCATION_PATH].self::$params[self::CLASS_NAME].$additional.".php",self::$classString);
        if(!empty($result)){
            return true;
        }

        return false;
    }
}