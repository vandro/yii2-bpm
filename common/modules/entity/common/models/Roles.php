<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "roles".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 *
 * @property NodeActionRoleLink[] $nodeActionRoleLinks
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'roles';
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
            [['title', 'code'], 'required'],
            [['title', 'code'], 'string'],
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
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodeActionRoleLinks()
    {
        return $this->hasMany(NodeActionRoleLink::className(), ['role_id' => 'id']);
    }

    public function getNodeViewRoleLinks()
    {
        return $this->hasMany(NodeViewRoleLink::className(), ['role_id' => 'id']);
    }

    public function getNodes()
    {
        return $this->hasMany(ProcessNodes::className(), ['id' => 'node_id'])
            ->via('nodeViewRoleLinks');
    }

    protected function getNodesIds()
    {
        $arIds = [];
        foreach($this->nodes as $node){
            $arIds[] = $node->id;
        }
        return $arIds;
    }

    public function getTasks()
    {
        return TasksCart::find()->where(['in','current_node_id', $this->nodesIds])->all();
    }

    protected function getLastNodesIds()
    {
//        $nodes = $this->getNodes()->where(['order_status' => 'last'])->all();
        $nodes =  $this->hasMany(ProcessNodes::className(), ['id' => 'node_id'])
            ->via('nodeViewRoleLinks')
            ->where(['order_status' => 'last'])->all();
        $arIds = [];
        foreach($nodes as $node){
            $arIds[] = $node->id;
        }
        return $arIds;
    }

    public function getTasksInLastNode()
    {
        return TasksCart::find()->where(['in','current_node_id', $this->lastNodesIds])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRightLinks()
    {
        return $this->hasMany(RightRoleLinks::className(), ['role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRights()
    {
        return $this->hasMany(Rights::className(), ['id' => 'right_id'])
            ->via('rightLinks');
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @return ActiveDataProvider
     */
    public function getRightLinksAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getRightLinks(),
        ]);

        return $dataProvider;
    }
}
