<?php

namespace common\modules\entity\common\models\permission;

use Yii;

/**
 * This is the model class for table "process_nodes".
 *
 * @property integer $id
 * @property integer $process_id
 * @property string $title
 * @property string $code
 * @property string $order_status
 * @property string $execution_type
 *
 * @property NodeActionRoleLink[] $nodeActionRoleLinks
 * @property NodeActionRoleLink[] $nodeActionRoleLinks0
 * @property NodeActionRoleLink[] $nodeActionRoleLinks1
 * @property NodeViewRoleLink[] $nodeViewRoleLinks
 * @property NodesActions[] $nodesActions
 * @property NodesActionsLang[] $nodesActionsLangs
 * @property Processes $process
 * @property ProcessNodesLang[] $processNodesLangs
 */
class Nodes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'process_nodes';
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
            [['process_id', 'title', 'code'], 'required'],
            [['process_id'], 'integer'],
            [['title', 'code', 'order_status', 'execution_type'], 'string'],
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
            'process_id' => Yii::t('app', 'Process ID'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
            'order_status' => Yii::t('app', 'Order Status'),
            'execution_type' => Yii::t('app', 'Execution Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodeActionRoleLinks()
    {
        return $this->hasMany(NodeActionRoleLink::className(), ['next_node_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodeActionRoleLinks0()
    {
        return $this->hasMany(NodeActionRoleLink::className(), ['action_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodeActionRoleLinks1()
    {
        return $this->hasMany(NodeActionRoleLink::className(), ['node_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodeViewRoleLinks()
    {
        return $this->hasMany(NodeViewRoleLink::className(), ['node_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodesActions()
    {
        return $this->hasMany(NodesActions::className(), ['next_node_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodesActionsLangs()
    {
        return $this->hasMany(NodesActionsLang::className(), ['main' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcess()
    {
        return $this->hasOne(Processes::className(), ['id' => 'process_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcessNodesLangs()
    {
        return $this->hasMany(ProcessNodesLang::className(), ['main' => 'id']);
    }

    /**
     * @inheritdoc
     * @return NodesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NodesQuery(get_called_class());
    }
}
