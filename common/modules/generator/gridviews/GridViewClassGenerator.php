<?php
/**
 * Author: Avazbek Niyazov
 * Email: avazbe@gmail.com
 * Date: 28.10.2015
 * Time: 10:32
 */
namespace common\modules\generator\gridviews;

use Yii;
use common\modules\entity\common\models\permission\Gridviews;
use common\modules\generator\models\GridViewActiveRecordClassGenerator;
use common\modules\generator\models\ActiveRecordClassGenerator;
use common\modules\generator\models\ActiveRecordSearchClassGenerator;
use common\modules\generator\models\ActiveRecordQueryClassGenerator;
use common\modules\generator\entity\EntityTypeClassGenerator;
use yii\web\NotFoundHttpException;
use common\helpers\DebugHelper;
use common\modules\generator\models\AbstractClassGenerator;

class GridViewClassGenerator extends EntityTypeClassGenerator
{
    protected static $gridView;

    public static function generateFile($grid_view_id, $namespace, $db, $fileLocationPath, $i18nMessageFileAlias = 'app')
    {
        self::setGridView($grid_view_id);
        self::setNameSpace($namespace);
        self::setClassName();
        self::setActiveQueryClassName('FormQuery');
        self::setDatabaseName($db);
        self::setAuthorName('Avazbek Niyazov');
        self::setI18NMessageFileAlias($i18nMessageFileAlias);
        self::setClassFileLocationPath($fileLocationPath);
        self::setSelectFields();
        self::setSelectEntityTypes();
        self::setTableName();
        self::setPropertyValidationRules([
            'required' => '\common\modules\generator\rules\ActiveRecordRequiredRuleGenerator',
            'string' => '\common\modules\generator\rules\ActiveRecordStringRuleGenerator',
            'integer' => '\common\modules\generator\rules\ActiveRecordIntegerRuleGenerator',
            'email' => '\common\modules\generator\rules\ActiveRecordEmailRuleGenerator',
        ]);

        $activeRecordGenerator = new GridViewActiveRecordClassGenerator(self::$params);
        $activeRecordGenerator->generateClassFile();
        return static::$params;
    }

    protected static function setGridView($id)
    {
        if (($model = Gridviews::findOne($id)) !== null) {
            self::$gridView = $model;
        } else {
            throw new NotFoundHttpException('The requested grid view does not exist.');
        }
    }

    protected function setClassName()
    {
        self::$params[AbstractClassGenerator::CLASS_NAME] = 'GridView'.self::$gridView->id;
    }

    protected function setActiveQueryClassName()
    {
        self::$params[AbstractClassGenerator::ACTIVE_QUERY_CLASS_NAME] = 'GridViewQuery'.self::$gridView->id;
    }

    protected function setTableName()
    {
        foreach(self::$params[AbstractClassGenerator::SELECTED_ENTITY_TYPES] as $entityType) {
            if(!isset($entityType[AbstractClassGenerator::ENTITY_TYPE_JOINS])) {
                self::$params[AbstractClassGenerator::TABLE_NAME] = $entityType[AbstractClassGenerator::ENTITY_TYPE_NAME];
                self::$params[AbstractClassGenerator::DATABASE_NAME] = $entityType[AbstractClassGenerator::ENTITY_TYPE_DATABASE];
            }
        }
    }

    protected function setSelectFields()
    {
        self::$params[AbstractClassGenerator::PROPERTIES] = [];
        foreach(self::$gridView->gridviewFields as $gridviewField)
        {
            $property = [
                AbstractClassGenerator::PROPERTY_NAME => $gridviewField->field->code,
                AbstractClassGenerator::PROPERTY_TYPE => self::$types[$gridviewField->field->type],
                AbstractClassGenerator::ENTITY_TYPE_NAME => $gridviewField->field->entity->code,
                AbstractClassGenerator::PROPERTY_LABEL => $gridviewField->field->title,
                AbstractClassGenerator::PROPERTY_VALIDATION_RULES => [
                    [
                        AbstractClassGenerator::PROPERTY_VALIDATION_RULE_TYPE => self::$types[$gridviewField->field->type],
                    ],
                ]
            ];

            if(!empty($gridviewField->field->dictionary)){
                $property[AbstractClassGenerator::DICTIONARY_NAME] = $gridviewField->field->dictionary->code;
                $property[AbstractClassGenerator::DICTIONARY_KEY_FIELD_NAME] = $gridviewField->field->getSetting("key");
                $property[AbstractClassGenerator::DICTIONARY_VALUE_FIELD_NAME] = $gridviewField->field->getSetting("value");
            }

            self::$params[AbstractClassGenerator::PROPERTIES][] = $property;
        }
    }

    protected function setSelectEntityTypes()
    {
        $arCachedEntityTypes = self::getCachedEntityTypes();

        $arEntityTypes = [];
        self::$params[AbstractClassGenerator::SELECTED_ENTITY_TYPES] = [];
        foreach(self::$gridView->gridviewFields as $gridviewField)
        {
            if(!in_array($gridviewField->field->entity->code, $arEntityTypes)) {
                $arJoins = self::getJoins($gridviewField->field->entity, $arCachedEntityTypes);
                if(!empty($arJoins)) {
                    self::$params[AbstractClassGenerator::SELECTED_ENTITY_TYPES][] = [
                        AbstractClassGenerator::ENTITY_TYPE_NAME => $gridviewField->field->entity->code,
                        AbstractClassGenerator::ENTITY_TYPE_DATABASE => $gridviewField->field->entity->database->code,
                        AbstractClassGenerator::ENTITY_TYPE_JOINS => $arJoins,
                    ];
                }else{
                    self::$params[AbstractClassGenerator::SELECTED_ENTITY_TYPES][] = [
                        AbstractClassGenerator::ENTITY_TYPE_NAME => $gridviewField->field->entity->code,
                        AbstractClassGenerator::ENTITY_TYPE_DATABASE => $gridviewField->field->entity->database->code,
                    ];
                }
                $arEntityTypes[] = $gridviewField->field->entity->code;
            }
        }
    }

    protected function getJoins($entityType, $arCachedEntityTypes)
    {
        $arJoins = [];

        foreach($entityType->fields as $field){
            if(!empty($field->dictionary)){
                foreach($arCachedEntityTypes as $cachedEntityType)
                if($field->dictionary->code == $cachedEntityType->code){
                    $arJoins[] = [
                        AbstractClassGenerator::PROPERTY_NAME => $field->code,
                        AbstractClassGenerator::DICTIONARY_NAME => $field->dictionary->code,
                        AbstractClassGenerator::DICTIONARY_KEY_FIELD_NAME => $field->getSetting("key"),
                    ];
                }
            }
        }

        return $arJoins;
    }

    protected function getCachedEntityTypes()
    {
        $arEntityTypes = [];
        foreach(self::$gridView->gridviewFields as $gridviewField) {
            if(!in_array($gridviewField->field->entity, $arEntityTypes)) {
                $arEntityTypes[] = $gridviewField->field->entity;
            }
        }
        return $arEntityTypes;
    }
}