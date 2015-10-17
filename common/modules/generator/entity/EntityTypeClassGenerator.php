<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 15.10.2015
 * Time: 15:32
 */
namespace common\modules\generator\entity;

use Yii;
use common\modules\generator\models\AbstractClassGenerator;
use common\modules\generator\models\ActiveRecordClassGenerator;
use common\modules\generator\models\ActiveRecordSearchClassGenerator;
use common\modules\entity\common\models\EntityTypes;
use common\modules\generator\models\ActiveRecordQueryClassGenerator;
use yii\web\NotFoundHttpException;

class EntityTypeClassGenerator
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

    public static function generateFile($entity_id, $namespace, $db, $fileLocationPath, $i18nMessageFileAlias = 'app')
    {
        self::setEntityType($entity_id);
        self::setNameSpace($namespace);
        self::setClassName();
        self::setActiveQueryClassName();
        self::setDatabaseName($db);
        self::setTableName();
        self::setAuthorName('Avazbek Niyazov');
        self::setI18NMessageFileAlias($i18nMessageFileAlias);
        self::setClassFileLocationPath($fileLocationPath);
        self::setPropertyValidationRules([
            'required' => '\common\modules\generator\rules\ActiveRecordRequiredRuleGenerator',
            'string' => '\common\modules\generator\rules\ActiveRecordStringRuleGenerator',
            'integer' => '\common\modules\generator\rules\ActiveRecordIntegerRuleGenerator',
            'email' => '\common\modules\generator\rules\ActiveRecordEmailRuleGenerator',
        ]);
        self::setProperties();

        $activeRecordGenerator = new ActiveRecordClassGenerator(self::$params);
        $activeRecordSearchGenerator = new ActiveRecordSearchClassGenerator(self::$params);
        $activeRecordQueryGenerator = new ActiveRecordQueryClassGenerator(self::$params);

        if($activeRecordGenerator->generateClassFile()){
            if($activeRecordSearchGenerator->generateClassFile()) {
                if($activeRecordQueryGenerator->generateClassFile()) {
                    return true;
                }
            }
        }

        return false;
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
        self::$params[AbstractClassGenerator::NAME_SPACE] = $nameSpace;
    }

    protected function setClassName($className = null)
    {
        self::$params[AbstractClassGenerator::CLASS_NAME] = !empty($className)?$className:self::getName(self::$entityType->code);
    }

    protected function setActiveQueryClassName($additional = 'Query')
    {
        self::$params[AbstractClassGenerator::ACTIVE_QUERY_CLASS_NAME] = self::getName(self::$entityType->code).$additional;
    }

    protected function setDatabaseName($databaseName)
    {
        self::$params[AbstractClassGenerator::DATABASE_NAME] = $databaseName;
    }

    protected function setTableName()
    {
        self::$params[AbstractClassGenerator::TABLE_NAME] = self::$entityType->code;
    }

    protected function setAuthorName($authorName)
    {
        self::$params[AbstractClassGenerator::AUTHOR_NAME] = $authorName;
    }

    protected function setI18NMessageFileAlias($alias)
    {
        self::$params[AbstractClassGenerator::I18N_MESSAGE_FILE_ALIAS] = $alias;
    }

    protected function setClassFileLocationPath($path)
    {
        self::$params[AbstractClassGenerator::CLASS_FILE_LOCATION_PATH] = $path;
    }

    protected function setPropertyValidationRules($validatorRules)
    {
        foreach($validatorRules as $rule => $className){
            self::$params[AbstractClassGenerator::PROPERTIES_VALIDATION_RULES][$rule] = [
                AbstractClassGenerator::CLASS_NAME => $className
            ];
        }
    }

    protected function setProperties()
    {
        self::$params[AbstractClassGenerator::PROPERTIES] = [];
        self::$params[AbstractClassGenerator::RELATIONS] = [];
        foreach(self::$entityType->fields as $field){
            self::$params[AbstractClassGenerator::PROPERTIES][] = [
                AbstractClassGenerator::PROPERTY_NAME => $field->code,
                AbstractClassGenerator::PROPERTY_TYPE => self::$types[$field->type],
                AbstractClassGenerator::PROPERTY_LABEL => $field->title,
                AbstractClassGenerator::PROPERTY_VALIDATION_RULES => [
                    [
                        AbstractClassGenerator::PROPERTY_VALIDATION_RULE_TYPE => self::$types[$field->type],
                    ],
                ]
            ];

            if(!empty($field->dictionary)) {
                $relation = [
                    AbstractClassGenerator::RELATION_METHOD_NAME => self::getMethodsName($field->code),
                    AbstractClassGenerator::RELATION_TYPE => AbstractClassGenerator::RELATION_TYPE_HAS_MANY,
                    AbstractClassGenerator::RELATION_FOREIGN_KEY => $field->code,
                    AbstractClassGenerator::RELATION_TARGET_KEY => 'id',
                    AbstractClassGenerator::RELATION_TARGET_CLASS => self::getName($field->dictionary->code),
                    AbstractClassGenerator::RELATION_TABLE_NAME => $field->dictionary->code,
                ];
                if (!in_array($relation, self::$params[AbstractClassGenerator::RELATIONS])) {
                    self::$params[AbstractClassGenerator::RELATIONS][] = $relation;
                }
            }
        }
    }

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
}