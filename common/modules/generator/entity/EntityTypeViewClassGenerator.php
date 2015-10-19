<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 15.10.2015
 * Time: 15:32
 */
namespace common\modules\generator\entity;

use Yii;
use common\modules\entity\common\models\EntityViews;
use common\modules\generator\models\AbstractClassGenerator;
use common\modules\generator\models\ActiveRecordClassGenerator;
use common\modules\generator\models\ActiveRecordSearchClassGenerator;
use common\modules\generator\models\ActiveRecordQueryClassGenerator;
use yii\web\NotFoundHttpException;

class EntityTypeViewClassGenerator extends EntityTypeClassGenerator
{
    protected static $view;

    public static function generateFile($view_id, $namespace, $db, $fileLocationPath, $i18nMessageFileAlias = 'app')
    {
        self::setView($view_id);
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
        self::setClassProperties();
        self::setEntityRelation();

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

    protected static function setView($id)
    {
        if (($model = EntityViews::findOne($id)) !== null) {
            self::$view = $model;
        } else {
            throw new NotFoundHttpException('The requested entity type view does not exist.');
        }
    }

    protected static function setEntityType()
    {
        self::$entityType = self::$view->entity;
    }

    protected function setClassName()
    {
        self::$params[AbstractClassGenerator::CLASS_NAME] = self::getName(self::$view->code).'View';
    }

    protected function setActiveQueryClassName()
    {
        self::$params[AbstractClassGenerator::ACTIVE_QUERY_CLASS_NAME] = self::getName(self::$view->code).'ViewQuery';
    }

    protected function setProperties()
    {
        self::$params[AbstractClassGenerator::PROPERTIES] = [];
        foreach(self::$view->rules as $rule){
            if(isset($rule->field)) {
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
            }
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
        if(!empty(self::$view->parentView)) {
            self::$params[AbstractClassGenerator::RELATIONS][] = [
                AbstractClassGenerator::RELATION_METHOD_NAME => self::getMethodsName(self::$view->parentView->code),
                AbstractClassGenerator::RELATION_TYPE => AbstractClassGenerator::RELATION_TYPE_HAS_ONE,
                AbstractClassGenerator::RELATION_FOREIGN_KEY => self::$view->foreignKeyField->code,
                AbstractClassGenerator::RELATION_TARGET_KEY => 'id',
                AbstractClassGenerator::RELATION_TARGET_CLASS => self::getName(self::$view->parentView->code),
                AbstractClassGenerator::RELATION_TABLE_NAME => self::$view->parentView->code,
            ];
        }

        if(!empty(self::$view->childViews)) {
            foreach(self::$view->childViews as $view) {
                $relation = [
                    AbstractClassGenerator::RELATION_METHOD_NAME => self::getMethodsName($view->code),
                    AbstractClassGenerator::RELATION_TYPE => AbstractClassGenerator::RELATION_TYPE_HAS_MANY,
                    AbstractClassGenerator::RELATION_FOREIGN_KEY => 'id',
                    AbstractClassGenerator::RELATION_TARGET_KEY => $view->foreignKeyField->code,
                    AbstractClassGenerator::RELATION_TARGET_CLASS => self::getName($view->code).'View',
                    AbstractClassGenerator::RELATION_TABLE_NAME => $view->entity->code,
                ];
                if(!in_array($relation, self::$params[AbstractClassGenerator::RELATIONS])) {
                    self::$params[AbstractClassGenerator::RELATIONS][] = $relation;
                }
            }
        }
    }
}