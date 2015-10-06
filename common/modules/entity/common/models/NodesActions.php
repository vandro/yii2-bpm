<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "nodes_actions".
 *
 * @property integer $id
 * @property integer $form_id
 * @property integer $next_node_id
 * @property string $title
 * @property string $code
 * @property string $type
 *
 * @property NodeActionRoleLink[] $nodeActionRoleLinks
 * @property ProcessNodes $nextNode
 * @property EntityForms $form
 * @property NodesActionsLang[] $nodesActionsLangs
 */
class NodesActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nodes_actions';
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
            [['form_id', 'next_node_id', 'title', 'code'], 'required'],
            [['form_id', 'next_node_id'], 'integer'],
            [['title', 'code', 'type'], 'string'],
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
            'form_id' => Yii::t('app', 'Form ID'),
            'next_node_id' => Yii::t('app', 'Next Node ID'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
            'type' => Yii::t('app', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodeActionRoleLinks()
    {
        return $this->hasMany(NodeActionRoleLink::className(), ['action_id' => 'id']);
    }

    public function getHasFileUploads($node_id)
    {
        $result = $this->getNodeActionRoleLinks()->where(['node_id' => $node_id])->one();
        if($result) {
            return $result->has_file_upload;
        }else{
            return false;
        }
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
    public function getForm()
    {
        return $this->hasOne(EntityForms::className(), ['id' => 'form_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(NodesActionsLang::className(), ['main' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getLangsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getLangs(),
        ]);

        return $dataProvider;
    }

    public function is_automatic()
    {
        return $this->type == 'automatic';
    }
}
