<?php

namespace common\modules\entity\common\models;

use common\modules\entity\common\config\Config;
use common\modules\entity\common\models\permission\NodesConditions;
use common\modules\entity\common\models\permission\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;


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
 * @property NodesActions[] $nodesActions
 * @property Processes $process
 * @property ProcessNodesLang[] $processNodesLangs
 */
class ProcessNodes extends \yii\db\ActiveRecord
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
            [['title', 'code'], 'required'],
            [['process_id'], 'integer'],
            [['title', 'code', 'order_status','execution_type'], 'string'],
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
            'order_status' => Yii::t('app', 'Order status'),
            'execution_type' => Yii::t('app', 'Execution Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActionRoleLinks()
    {
        return $this->hasMany(NodeActionRoleLink::className(), ['node_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewRoleLinks()
    {
        return $this->hasMany(NodeViewRoleLink::className(), ['node_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewUserRoleLinks()
    {
        $user = User::findOne(Yii::$app->user->id);
        $userRolesIds = [];
        foreach($user->roles as $role){
            $userRolesIds[] = $role->id;
        }
        return $this->hasMany(NodeViewRoleLink::className(), ['node_id' => 'id'])->where(['in', 'role_id', $userRolesIds]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserViews()
    {
        return $this->hasMany(EntityViews::className(), ['id' => 'view_id'])
            ->via('viewUserRoleLinks')->distinct();
    }


    public function getNextNodeId($action)
    {
        if (($model = NodeActionRoleLink::find()->where(['node_id' => $this->id, 'action_id' => $action->id])->one()) !== null) {
            return $model->next_node_id;
        } else {
            return null;
        }
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getActionRoleLinksAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getActionRoleLinks(),
        ]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getViewRoleLinksAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getViewRoleLinks(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViews()
    {
        return $this->hasMany(EntityViews::className(), ['id' => 'view_id'])
            ->via('viewRoleLinks');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasMany(Roles::className(), ['id' => 'role_id'])
            ->via('viewRoleLinks');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActions()
    {
        return $this->hasMany(NodesActions::className(), ['id' => 'action_id'])
            ->via('actionRoleLinks');
    }

    public function getNodeActions()
    {
        return ArrayHelper::map($this->actions, 'id', 'title');
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getActionsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getActions(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditions()
    {
        return $this->hasMany(NodesConditions::className(), ['node_id' => 'id']);
    }

    public function getNodeConditions()
    {
        return ArrayHelper::map($this->conditions, 'id', 'title');
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getConditionsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getConditions(),
        ]);

        return $dataProvider;
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
    public function getLangs()
    {
        return $this->hasMany(ProcessNodesLang::className(), ['main' => 'id']);
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

    public function is_first()
    {
        return $this->order_status == 'first';
    }

    public function is_last()
    {
        return $this->order_status == 'last';
    }

    public function is_automatic()
    {
        return $this->execution_type == 'automatic';
    }

    public function getAutomaticActionId()
    {
        foreach ($this->actionRoleLinks as $actionRoleLink) {
            if ($actionRoleLink->is_automatic()) {
                return $actionRoleLink->action_id;
            }
        }
    }

    public function getNextActionId($taskId)
    {
        foreach($this->conditions as $condition){
            if(!$condition->hasParent()) {
                $next = $condition->getNext($taskId);
                if(!empty($next)) {
                    return $next->id;
                }else{
                    // A если пусто то отправить в конечную ноду;
                    return false;
                }
            }
        }
    }

    public function getActionsUrls($task)
    {
        $items = [];
        $user = User::findOne(Yii::$app->user->id);

        foreach ($this->actions as $action) {
            //if($user->hasActionAccess($action, $this)) {
                $items[] = ['label' => $action->title, 'url' => Yii::$app->getUrlManager()->createUrl([Config::MODULE_NAME . '/actions-cart/form', 'id' => $action->id, 'task_id' => $task->id])];
            //}
        }


        return $items;
    }

    public function getAllViews()
    {
        return ArrayHelper::map(EntityViews::find()->all(), 'id', 'title');
    }
}
