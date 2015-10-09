<?php

namespace common\modules\entity\common\models\permission;

use Yii;

/**
 * This is the model class for table "node_action_role_link".
 *
 * @property integer $id
 * @property integer $node_id
 * @property integer $action_id
 * @property integer $role_id
 * @property integer $next_node_id
 * @property string $execution_type
 * @property integer $only_one_entity
 * @property integer $cart_data_transfer
 *
 * @property ProcessNodes $nextNode
 * @property Roles $role
 * @property ProcessNodes $action
 * @property ProcessNodes $node
 */
class NodesActionRoleLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'node_action_role_link';
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
            [['node_id', 'action_id', 'role_id'], 'required'],
            [['node_id', 'action_id', 'role_id', 'next_node_id', 'only_one_entity', 'cart_data_transfer'], 'integer'],
            [['execution_type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'node_id' => Yii::t('app', 'Шаг'),
            'action_id' => Yii::t('app', 'Действия'),
            'role_id' => Yii::t('app', 'Роль'),
            'next_node_id' => Yii::t('app', 'Следуший шаг'),
            'execution_type' => Yii::t('app', 'Выполнение'),
            'only_one_entity' => Yii::t('app', 'Только один объект'),
            'cart_data_transfer' => Yii::t('app', 'Корзина для отпраления'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNextNode()
    {
        return $this->hasOne(ProcessNodes::className(), ['id' => 'next_node_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(ProcessNodes::className(), ['id' => 'action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNode()
    {
        return $this->hasOne(ProcessNodes::className(), ['id' => 'node_id']);
    }

    /**
     * @inheritdoc
     * @return NodesActionRoleLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NodesActionRoleLinkQuery(get_called_class());
    }
}
