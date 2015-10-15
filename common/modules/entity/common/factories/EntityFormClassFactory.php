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

class EntityFormClassFactory
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
            'required' => '\common\modules\entity\common\factories\ActiveRecordRequiredRuleFactory',
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
        self::$params[ActiveRecordClassFactory::NAME_SPACE] = $nameSpace;
    }

    protected function setClassName()
    {
        self::$params[ActiveRecordClassFactory::CLASS_NAME] = self::getName(self::$form->code).'Form';
    }

    protected function setActiveQueryClassName()
    {
        self::$params[ActiveRecordClassFactory::ACTIVE_QUERY_CLASS_NAME] = self::getName(self::$form->code).'FormQuery';
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
        foreach(self::$form->rules as $rule){
            self::$params[ActiveRecordClassFactory::PROPERTIES][] = [
                ActiveRecordClassFactory::PROPERTY_NAME => $rule->field->code,
                ActiveRecordClassFactory::PROPERTY_TYPE => self::$types[$rule->field->type],
                ActiveRecordClassFactory::PROPERTY_LABEL => $rule->field->title,
                ActiveRecordClassFactory::PROPERTY_VALIDATION_RULES => [
                    [
                        ActiveRecordClassFactory::PROPERTY_VALIDATION_RULE_TYPE => $rule->code,
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