<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\HttpException;

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
            'form_id' => Yii::t('app', 'Таблица'),
            'next_node_id' => Yii::t('app', 'Следуший шаг'),
            'title' => Yii::t('app', 'Наименования'),
            'code' => Yii::t('app', 'Код'),
            'type' => Yii::t('app', 'Тип'),
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

    public function getActionHandlerLinks()
    {
        return $this->hasMany(ActionHandlerLink::className(), ['action_id' => 'id'])
            ->via('nodeActionRoleLinks');
    }

    public function getHandlers()
    {
        return $this->hasMany(Handlers::className(), ['id' => 'handler_id'])
            ->via('actionHandlerLinks');
    }

    public function runHandlers()
    {
        foreach($this->actionHandlerLinks as $link){
            $handlerClass = $link->handler->class;
            $handler = new $handlerClass(json_decode($link->settings, true));
            if($handler->run()){
                continue;
            }else{
                throw new HttpException(404, 'Handler "'.$link->$link->handler->class.'" failed');
            }
        }

        return true;
    }

//    public function runHandlers()
//    {
//        foreach($this->actionHandlerLinks as $link){
//            $container = new Container;
//            $container->set($link->handler->code, [
//                'class' => $link->handler->class,
//                'settings' => json_decode($link->settings,true),
//            ]);
//
//            $handler = $container->get($link->handler->code);
//
//            $handler->run();
//        }
//    }
}
