<?php

namespace common\modules\entity\common\models\permission;

use common\modules\entity\common\models\EntityFields;
use common\modules\entity\common\models\EntityTypes;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "gridview_fields".
 *
 * @property integer $id
 * @property integer $gridview_id
 * @property integer $entity_type_id
 * @property integer $field_id
 * @property string $condition
 * @property string $value
 * @property integer $order
 *
 * @property Gridviews $gridview
 */
class GridviewFields extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gridview_fields';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gridview_id', 'entity_type_id', 'field_id'], 'required'],
            [['gridview_id', 'entity_type_id', 'field_id', 'order'], 'integer'],
            [['condition', 'value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'gridview_id' => Yii::t('app', 'Gridview ID'),
            'entity_type_id' => Yii::t('app', 'Entity Type ID'),
            'field_id' => Yii::t('app', 'Field ID'),
            'order' => Yii::t('app', 'Order'),
            'condition' => Yii::t('app', 'Condition'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGridview()
    {
        return $this->hasOne(Gridviews::className(), ['id' => 'gridview_id']);
    }

    /**
     * @inheritdoc
     * @return GridviewFieldsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GridviewFieldsQuery(get_called_class());
    }

    public function getEntityType()
    {
        return $this->hasOne(EntityTypes::className(), ['id' => 'entity_type_id']);
    }

    public function getField()
    {
        return $this->hasOne(EntityFields::className(), ['id' => 'field_id']);
    }

    public function getAllEntityTypes()
    {
        return ArrayHelper::map(EntityTypes::find()->all(), 'id', 'title');
    }

    public function getAllEntityTypeFields()
    {
        return ArrayHelper::map(EntityFields::find()->where(['entity_id' => $this->entity_type_id])->all(), 'id', 'title');
    }

    public function getAllConditionsTypes()
    {
        return [
            'equal' => 'Equal',
            'notequal' => 'Not Equal',
            'greater' => 'Greater',
            'smaller' => 'Smaller',
            'contains' => 'Contains',
            'notcontains' => 'Not Contains',
            'between' => 'Between',
            'notbetween' => 'Not Between',
        ];
    }


}
