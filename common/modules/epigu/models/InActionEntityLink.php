<?php

namespace common\modules\epigu\models;

use common\modules\entity\common\models\EntityTypes;
use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "in_action_entity_link".
 *
 * @property integer $id
 * @property integer $integration_action_id
 * @property integer $entity_type_id
 *
 * @property EpiguAndEntityFieldsLink[] $epiguAndEntityFieldsLinks
 * @property IntegrationActions $integrationAction
 */
class InActionEntityLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'in_action_entity_link';
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
            [['integration_action_id', 'entity_type_id'], 'required'],
            [['integration_action_id', 'entity_type_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'integration_action_id' => Yii::t('app', 'Интеграционный действий'),
            'entity_type_id' => Yii::t('app', 'Тип объекта'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEpiguAndEntityFieldsLinks()
    {
        return $this->hasMany(EpiguAndEntityFieldsLink::className(), ['in_action_entity_link_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIntegrationAction()
    {
        return $this->hasOne(IntegrationActions::className(), ['id' => 'integration_action_id']);
    }

    /**
     * @inheritdoc
     * @return InActionEntityLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new InActionEntityLinkQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityType()
    {
        return $this->hasOne(EntityTypes::className(), ['id' => 'entity_type_id']);
    }

    public function getAllEntityType()
    {
        return ArrayHelper::map(EntityTypes::find()->all(), 'id', 'title');
    }

    public function getEpiguAndEntityFieldsLinksAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getEpiguAndEntityFieldsLinks(),
        ]);

        return $dataProvider;
    }
}
