<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 15.10.2015
 * Time: 15:32
 */
namespace common\modules\entity\common\factories;

use common\modules\entity\common\models\EntityForms;
use Yii;
use common\modules\entity\common\models\EntityTypes;
use yii\web\NotFoundHttpException;

class EntityFormClassGenerationFactory
{
    protected static $params;
    protected static $entityType;
    protected static $form;

    protected static $types = [
        'VARCHAR' => 'string',
        'TEXT' => 'string',
        'INT' => 'integer',
        'DATE' => 'date',
    ];

    public static function generateFile($form_id)
    {
        self::setForm($form_id);
        self::setEntityType($form_id);
        self::setNameSpace('common\modules\entity\common\entities\forms');
        self::setClassName();
        self::setActiveQueryClassName();
        self::setDatabaseName('pdb');
        self::setTableName();
        self::setAuthorName('Avazbek Niyazov');
        self::setI18NMessageFileAlias('app');
        self::setClassFileLocationPath(Yii::$app->basePath.'/../common/modules/entity/common/entities/forms/');
        self::setPropertyValidationRules([
            'required' => '\common\modules\entity\common\factories\ActiveRecordRequiredRuleGenerationFactory',
            'string' => '\common\modules\entity\common\factories\ActiveRecordStringRuleGenerationFactory',
            'integer' => '\common\modules\entity\common\factories\ActiveRecordIntegerRuleGenerationFactory',
            'email' => '\common\modules\entity\common\factories\ActiveRecordEmailRuleGenerationFactory',
        ]);
        self::setProperties();

        if(ActiveRecordClassGenerationFactory::generateClassFile(self::$params)){
            if(ActiveRecordSearchClassGenerationFactory::generateClassFile(self::$params)){
                return true;
            }
        }

        return false;
    }

    protected static function setForm($id)
    {
        if (($model = EntityForms::findOne($id)) !== null) {
            self::$form = $model;
        } else {
            throw new NotFoundHttpException('The requested entity type form does not exist.');
        }
    }

    protected static function setEntityType()
    {
        self::$entityType = self::$form->entity;
    }

    protected function setNameSpace($nameSpace)
    {
        self::$params[ActiveRecordClassGenerationFactory::NAME_SPACE] = $nameSpace;
    }

    protected function setClassName()
    {
        self::$params[ActiveRecordClassGenerationFactory::CLASS_NAME] = self::getName(self::$form->code).'Form';
    }

    protected function setActiveQueryClassName()
    {
        self::$params[ActiveRecordClassGenerationFactory::ACTIVE_QUERY_CLASS_NAME] = self::getName(self::$form->code).'FormQuery';
    }

    protected function setDatabaseName($databaseName)
    {
        self::$params[ActiveRecordClassGenerationFactory::DATABASE_NAME] = $databaseName;
    }

    protected function setTableName()
    {
        self::$params[ActiveRecordClassGenerationFactory::TABLE_NAME] = self::$entityType->code;
    }

    protected function setAuthorName($authorName)
    {
        self::$params[ActiveRecordClassGenerationFactory::AUTHOR_NAME] = $authorName;
    }

    protected function setI18NMessageFileAlias($alias)
    {
        self::$params[ActiveRecordClassGenerationFactory::I18N_MESSAGE_FILE_ALIAS] = $alias;
    }

    protected function setClassFileLocationPath($path)
    {
        self::$params[ActiveRecordClassGenerationFactory::CLASS_FILE_LOCATION_PATH] = $path;
    }

    protected function setPropertyValidationRules($validatorRules)
    {
        foreach($validatorRules as $rule => $className){
            self::$params[ActiveRecordClassGenerationFactory::PROPERTIES_VALIDATION_RULES][$rule] = [
                ActiveRecordClassGenerationFactory::CLASS_NAME => $className
            ];
        }
    }

    protected function setProperties()
    {
        self::$params[ActiveRecordClassGenerationFactory::PROPERTIES] = [];
        foreach(self::$form->rules as $rule){
            self::$params[ActiveRecordClassGenerationFactory::PROPERTIES][] = [
                ActiveRecordClassGenerationFactory::PROPERTY_NAME => $rule->field->code,
                ActiveRecordClassGenerationFactory::PROPERTY_TYPE => self::$types[$rule->field->type],
                ActiveRecordClassGenerationFactory::PROPERTY_LABEL => $rule->field->title,
                ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULES => [
                    [
                        ActiveRecordClassGenerationFactory::PROPERTY_VALIDATION_RULE_TYPE => $rule->code,
                    ],
                ],
                ActiveRecordClassGenerationFactory::PROPERTY_RELATION => self::getPropertyRelation($rule),
            ];
        }
    }

    protected function getPropertyRelation($rule)
    {
        if(!empty($rule->field->dictionary)) {
            return [
                ActiveRecordClassGenerationFactory::PROPERTY_RELATION_METHOD_NAME => self::getMethodsName($rule->field->code),
                ActiveRecordClassGenerationFactory::PROPERTY_RELATION_TYPE => ActiveRecordClassGenerationFactory::RELATION_TYPE_HAS_MANY,
                ActiveRecordClassGenerationFactory::PROPERTY_RELATION_FOREIGN_KEY => $rule->field->code,
                ActiveRecordClassGenerationFactory::PROPERTY_RELATION_TARGET_KEY => 'id',
                ActiveRecordClassGenerationFactory::PROPERTY_RELATION_TARGET_CLASS => self::getName($rule->field->dictionary->code),
            ];
        }

        return null;
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

    private static function getMethodsName($nameString)
    {
        $replaceItems = ['id', 'Id', 'ID', '_id', '_Id', '_ID', '_id_', '_Id_', '_ID_',];

        foreach($replaceItems as $item) {
            $nameString = str_replace($item, '', $nameString);
        }

        $name = self::getName($nameString);

        return $name;
    }
}