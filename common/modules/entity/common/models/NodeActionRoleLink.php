<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "node_action_role_link".
 *
 * @property integer $node_id
 * @property integer $action_id
 * @property integer $role_id
 * @property integer $next_node_id
 * @property string $execution_type
 * @property integer $only_one_entity
 *
 * @property Roles $role
 * @property NodesActions $action
 * @property ProcessNodes $node
 */
class NodeActionRoleLink extends \yii\db\ActiveRecord
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
            [['action_id', 'role_id'], 'required'],
            [['node_id', 'action_id', 'role_id', 'next_node_id', 'only_one_entity', 'has_file_upload'], 'integer'],
            [['execution_type'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'node_id' => Yii::t('app', 'Node ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'role_id' => Yii::t('app', 'Role ID'),
            'next_node_id' => Yii::t('app', 'Next Node ID'),
            'execution_type' => Yii::t('app', 'Execution type'),
            'only_one_entity' => Yii::t('app', 'Only one entity (yes/no)'),
            'has_file_upload' => Yii::t('app', 'Has file upload (yes/no)'),
        ];
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
        return $this->hasOne(NodesActions::className(), ['id' => 'action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNode()
    {
        return $this->hasOne(ProcessNodes::className(), ['id' => 'node_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNextNode()
    {
        return $this->hasOne(ProcessNodes::className(), ['id' => 'next_node_id']);
    }

    public function is_automatic()
    {
        return $this->execution_type == 'automatic';
    }

    public function getHandlers()
    {
        return $this->hasMany(ActionHandlerLink::className(), ['action_id' => 'action_id']);
    }

    public function getHandlersAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getHandlers(),
        ]);

        return $dataProvider;
    }
}
