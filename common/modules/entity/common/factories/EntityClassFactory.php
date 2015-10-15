<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 15.10.2015
 * Time: 15:32
 */
namespace common\modules\entity\common\factories;

use Yii;
use common\modules\entity\common\models\EntityTypes;
use yii\web\NotFoundHttpException;

class EntityClassFactory
{
    protected static $params;
    protected static $entityType;
    protected static $entity;

    protected static $types = [
        'VARCHAR' => 'string',
        'TEXT' => 'string',
        'INT' => 'integer',
        'DATE' => 'date',
    ];

    public static function generateFile($entity_id)
    {
        self::setEntityType($entity_id);
        self::setNameSpace('common\modules\entity\common\entities');
        self::setClassName();
        self::setActiveQueryClassName();
        self::setDatabaseName('pdb');
        self::setTableName();
        self::setAuthorName('Avazbek Niyazov');
        self::setI18NMessageFileAlias('app');
        self::setClassFileLocationPath(Yii::$app->basePath.'/../common/modules/entity/common/entities/');
        self::setPropertyValidationRules([
            'string' => '\common\modules\entity\common\factories\ActiveRecordStringRuleFactory',
            'integer' => '\common\modules\entity\common\factories\ActiveRecordIntegerRuleFactory',
            'email' => '\common\modules\entity\common\factories\ActiveRecordEmailRuleFactory',
        ]);
        self::setProperties();

        if(ActiveRecordClassFactory::generateClassFile(self::$params)){
            return true;
        }else{
            return false;
        }
    }

    protected static function setEntityType($id)
    {
        if (($model = EntityTypes::findOne($id)) !== null) {
            self::$entityType = $model;
        } else {
            throw new NotFoundHttpException('The requested entity type does not exist.');
        }
    }

    protected function setNameSpace($nameSpace)
    {
        self::$params[ActiveRecordClassFactory::NAME_SPACE] = $nameSpace;
    }

    protected function setClassName()
    {
        self::$params[ActiveRecordClassFactory::CLASS_NAME] = self::getName(self::$entityType->code);
    }

    protected function setActiveQueryClassName()
    {
        self::$params[ActiveRecordClassFactory::ACTIVE_QUERY_CLASS_NAME] = self::getName(self::$entityType->code).'Query';
    }

    protected function setDatabaseName($databaseName)
    {
        self::$params[ActiveRecordClassFactory::DATABASE_NAME] = $databaseName;
    }

    protected function setTableName()
    {
        self::$params[ActiveRecordClassFactory::TABLE_NAME] = self::$entityType->code;
    }

    protected function setAuthorName($authorName)
    {
        self::$params[ActiveRecordClassFactory::AUTHOR_NAME] = $authorName;
    }

    protected function setI18NMessageFileAlias($alias)
    {
        self::$params[ActiveRecordClassFactory::I18N_MESSAGE_FILE_ALIAS] = $alias;
    }

    protected function setClassFileLocationPath($path)
    {
        self::$params[ActiveRecordClassFactory::CLASS_FILE_LOCATION_PATH] = $path;
    }

    protected function setPropertyValidationRules($validatorRules)
    {
        foreach($validatorRules as $rule => $className){
            self::$params[ActiveRecordClassFactory::PROPERTIES_VALIDATION_RULES][$rule] = [
                ActiveRecordClassFactory::CLASS_NAME => $className
            ];
        }
    }

    protected function setProperties()
    {
        self::$params[ActiveRecordClassFactory::PROPERTIES] = [];
        foreach(self::$entityType->fields as $field){
            self::$params[ActiveRecordClassFactory::PROPERTIES][] = [
                ActiveRecordClassFactory::PROPERTY_NAME => $field->code,
                ActiveRecordClassFactory::PROPERTY_TYPE => self::$types[$field->type],
                ActiveRecordClassFactory::PROPERTY_LABEL => $field->title,
                ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES => [
                    [
                        ActiveRecordClassFactory::PROPERTY_VALIDATION_RULE_TYPE => self::$types[$field->type],
                    ],
                ]
            ];
        }
    }

    private static function getName($nameString)
    {
        $name = '';
        $arName = explode("_",$nameString);
        foreach($arName as $nameItem){
            $name .= ucfirst($nameItem);
        }

        return $name;
    }
}