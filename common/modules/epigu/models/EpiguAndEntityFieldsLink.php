<?php

namespace common\modules\epigu\models;

use common\modules\entity\common\models\EntityFields;
use common\modules\entity\common\models\EntityTypes;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "epigu_and_entity_fields_link".
 *
 * @property integer $id
 * @property integer $in_action_entity_link_id
 * @property integer $epigu_service_id
 * @property integer $epigu_service_field_id
 * @property integer $entity_type_id
 * @property integer $entity_type_fields_id
 *
 * @property EpiguServiceFileds $epiguServiceField
 * @property EpiguService $epiguService
 * @property InActionEntityLink $inActionEntityLink
 */
class EpiguAndEntityFieldsLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'epigu_and_entity_fields_link';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('edb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['in_action_entity_link_id', 'epigu_service_id', 'epigu_service_field_id', 'entity_type_id', 'entity_type_fields_id'], 'required'],
            [['in_action_entity_link_id', 'epigu_service_id', 'epigu_service_field_id', 'entity_type_id', 'entity_type_fields_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'in_action_entity_link_id' => Yii::t('app', 'In Action Entity Link ID'),
            'epigu_service_id' => Yii::t('app', 'Epigu Service ID'),
            'epigu_service_field_id' => Yii::t('app', 'Epigu Service Field ID'),
            'entity_type_id' => Yii::t('app', 'Entity Type ID'),
            'entity_type_fields_id' => Yii::t('app', 'Entity Type Fields ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpiguServiceField()
    {
        return $this->hasOne(EpiguServiceFileds::className(), ['id' => 'epigu_service_field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpiguService()
    {
        return $this->hasOne(EpiguService::className(), ['id' => 'epigu_service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInActionEntityLink()
    {
        return $this->hasOne(InActionEntityLink::className(), ['id' => 'in_action_entity_link_id']);
    }

    public function getEntityType()
    {
        return $this->hasOne(EntityTypes::className(), ['id' => 'entity_type_id']);
    }

    public function getEntityTypeField()
    {
        return $this->hasOne(EntityFields::className(), ['id' => 'entity_type_fields_id']);
    }

    /**
     * @inheritdoc
     * @return EpiguAndEntityFieldsLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EpiguAndEntityFieldsLinkQuery(get_called_class());
    }

    public function getAllEpiguServices()
    {
        return ArrayHelper::map(EpiguService::find()->all(), 'id', 'title');
    }

    public function getAllEpiguServicesFields()
    {
        return ArrayHelper::map(EpiguServiceFileds::find()->where(['epigu_service_id' => $this->epigu_service_id])->all(), 'id', 'label_ru');
    }

    public function getAllEntityType()
    {
        return ArrayHelper::map(EntityTypes::find()->all(), 'id', 'title');
    }

    public function getAllEntityTypeFields()
    {
        return ArrayHelper::map(EntityFields::find()->where(['entity_id' => $this->entity_type_id])->all(), 'id', 'title');
    }
}
