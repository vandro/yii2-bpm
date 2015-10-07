<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "action_handler_link".
 *
 * @property integer $id
 * @property integer $action_id
 * @property integer $handler_id
 * @property string $settings
 * @property string $type
 *
 * @property Handlers $handler
 * @property NodesActions $action
 */
class ActionHandlerLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'action_handler_link';
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
            [['action_id', 'handler_id'], 'required'],
            [['action_id', 'handler_id'], 'integer'],
            [['settings', 'type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'handler_id' => Yii::t('app', 'Handler ID'),
            'settings' => Yii::t('app', 'Settings'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHandler()
    {
        return $this->hasOne(Handlers::className(), ['id' => 'handler_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(NodesActions::className(), ['id' => 'action_id']);
    }

    /**
     * @inheritdoc
     * @return ActionHandlerLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActionHandlerLinkQuery(get_called_class());
    }

    public function getAllHandlers()
    {
        return ArrayHelper::map(Handlers::find()->all(), 'id', 'title');
    }
}
