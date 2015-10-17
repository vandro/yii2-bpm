<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 15.10.2015
 * Time: 15:32
 */
namespace common\modules\generator\entity;

use Yii;
use common\modules\entity\common\models\EntityForms;
use common\modules\generator\models\AbstractClassGenerator;
use common\modules\generator\models\ActiveRecordClassGenerator;
use common\modules\generator\models\ActiveRecordSearchClassGenerator;
use common\modules\generator\models\ActiveRecordQueryClassGenerator;
use yii\web\NotFoundHttpException;

class EntityTypeFormClassGenerator extends EntityTypeClassGenerator
{
    protected static $form;

    public static function generateFile($form_id, $namespace, $db, $fileLocationPath, $i18nMessageFileAlias = 'app')
    {
        self::setForm($form_id);
        self::setEntityType();
        self::setNameSpace($namespace);
        self::setClassName();
        self::setActiveQueryClassName('FormQuery');
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
        self::setRelations();
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

    protected function setClassName()
    {
        self::$params[AbstractClassGenerator::CLASS_NAME] = self::getName(self::$form->code).'Form';
    }

    protected function setActiveQueryClassName()
    {
        self::$params[AbstractClassGenerator::ACTIVE_QUERY_CLASS_NAME] = self::getName(self::$form->code).'FormQuery';
    }

    protected function setProperties()
    {
        self::$params[AbstractClassGenerator::PROPERTIES] = [];
        foreach(self::$form->rules as $rule){
            self::$params[AbstractClassGenerator::PROPERTIES][] = [
                AbstractClassGenerator::PROPERTY_NAME => $rule->field->code,
                AbstractClassGenerator::PROPERTY_TYPE => self::$types[$rule->field->type],
                AbstractClassGenerator::PROPERTY_LABEL => $rule->field->title,
                AbstractClassGenerator::PROPERTY_VALIDATION_RULES => [
                    [
                        AbstractClassGenerator::PROPERTY_VALIDATION_RULE_TYPE => $rule->code,
                    ],
                ],
            ];
            if(!empty($rule->field->dictionary)) {
                $relation = [
                    AbstractClassGenerator::RELATION_METHOD_NAME => self::getMethodsName($rule->field->code),
                    AbstractClassGenerator::RELATION_TYPE => AbstractClassGenerator::RELATION_TYPE_HAS_MANY,
                    AbstractClassGenerator::RELATION_FOREIGN_KEY => $rule->field->code,
                    AbstractClassGenerator::RELATION_TARGET_KEY => 'id',
                    AbstractClassGenerator::RELATION_TARGET_CLASS => self::getName($rule->field->dictionary->code),
                    AbstractClassGenerator::RELATION_TABLE_NAME => $rule->field->dictionary->code,
                ];
                if (!in_array($relation, self::$params[AbstractClassGenerator::RELATIONS])) {
                    self::$params[AbstractClassGenerator::RELATIONS][] = $relation;
                }
            }

        }
    }

    protected function setRelations()
    {
        self::$params[AbstractClassGenerator::RELATIONS] = [];
        if(!empty(self::$form->parentForm)) {
            self::$params[AbstractClassGenerator::RELATIONS][] = [
                AbstractClassGenerator::RELATION_METHOD_NAME => self::getMethodsName(self::$form->parentForm->code),
                AbstractClassGenerator::RELATION_TYPE => AbstractClassGenerator::RELATION_TYPE_HAS_ONE,
                AbstractClassGenerator::RELATION_FOREIGN_KEY => self::$form->foreignKeyField->code,
                AbstractClassGenerator::RELATION_TARGET_KEY => 'id',
                AbstractClassGenerator::RELATION_TARGET_CLASS => self::getName(self::$form->parentForm->code),
                AbstractClassGenerator::RELATION_TABLE_NAME => self::$form->parentForm->entity->code,
            ];
        }

        if(!empty(self::$form->childForms)) {
            foreach(self::$form->childForms as $form) {
                $relation = [
                    AbstractClassGenerator::RELATION_METHOD_NAME => self::getMethodsName($form->code),
                    AbstractClassGenerator::RELATION_TYPE => AbstractClassGenerator::RELATION_TYPE_HAS_MANY,
                    AbstractClassGenerator::RELATION_FOREIGN_KEY => 'id',
                    AbstractClassGenerator::RELATION_TARGET_KEY => $form->foreignKeyField->code,
                    AbstractClassGenerator::RELATION_TARGET_CLASS => self::getName($form->code) . 'Form',
                    AbstractClassGenerator::RELATION_TABLE_NAME => $form->entity->code,
                ];
                if(!in_array($relation, self::$params[AbstractClassGenerator::RELATIONS])) {
                    self::$params[AbstractClassGenerator::RELATIONS][] = $relation;
                }
            }
        }
    }
}