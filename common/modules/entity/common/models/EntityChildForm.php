<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "entity_child_form".
 *
 * @property integer $id
 * @property string $parent_form_id
 * @property integer $entity_type_id
 * @property string $foreign_key_field_id
 * @property string $title
 * @property string $code
 * @property integer $widget
 * @property string $options
 * @property string $html
 * @property integer $added
 * @property string $mode
 *
 * @property EntityFields $foreignKeyField
 * @property EntityTypes $entityType
 * @property EntityForms $parentForm
 */
class EntityChildForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_child_form';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('sdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_form_id', 'entity_type_id', 'title', 'code'], 'required'],
            [['title', 'code', 'options', 'html', 'mode'], 'string'],
            [['parent_form_id', 'foreign_key_field_id', 'entity_type_id', 'widget', 'added'], 'integer'],
            [['code'], 'unique'],
            [['title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent_form_id' => Yii::t('app', 'Parent Form ID'),
            'entity_type_id' => Yii::t('app', 'Entity Type ID'),
            'foreign_key_field_id' => Yii::t('app', 'Foreign Key Field ID'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
            'widget' => Yii::t('app', 'Widget'),
            'options' => Yii::t('app', 'Options'),
            'html' => Yii::t('app', 'Html'),
            'added' => Yii::t('app', 'Added'),
            'mode' => Yii::t('app', 'Mode'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForeignKeyField()
    {
        return $this->hasOne(EntityFields::className(), ['id' => 'foreign_key_field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityType()
    {
        return $this->hasOne(EntityTypes::className(), ['id' => 'entity_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentForm()
    {
        return $this->hasOne(EntityForms::className(), ['id' => 'parent_form_id']);
    }

    /**
     * @inheritdoc
     * @return EntityChildFormQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EntityChildFormQuery(get_called_class());
    }

    public function getAllEntityTypes()
    {
        return ArrayHelper::map(EntityTypes::find()->all(), 'id', 'title');
    }

    public function getAllEntityTypeFields()
    {
        return ArrayHelper::map(EntityFields::find()->where(['entity_id' => $this->entity_type_id])->all(), 'id', 'title');
    }
}
