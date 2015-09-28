<?php

namespace common\modules\entity\common\models\permission;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\permission\Tasks;
use yii\db\Query;
use yii\web\HttpException;

/**
 * TasksSearch represents the model behind the search form about `common\modules\entity\common\models\permission\Tasks`.
 */
class ComplexTasksSearch extends Tasks
{
    private $_query;

    /**
     * @return mixed
     */
    public function getQuery()
    {
        if(empty($this->_query)){
            $this->_query = Tasks::find();
        }
        return $this->_query;
    }

    /**
     * @param mixed $query
     */
    public function setQuery($query)
    {
        $this->_query = $query;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'process_id', 'organisation_id', 'department_id', 'author_id', 'current_node_id', 'active', 'assigned_to_id'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param ActiveQuery $query
     *
     * @return ActiveDataProvider
     */
    public function search($params, $query)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->orderBy('id desc');

        $query->andFilterWhere([
            'id' => $this->id,
            'process_id' => $this->process_id,
            'organisation_id' => $this->organisation_id,
            'department_id' => $this->department_id,
            'author_id' => $this->author_id,
            'assigned_to_id' => $this->assigned_to_id,
            'current_node_id' => $this->current_node_id,
            'active' => $this->active,
            'created_at' => $this->created_at,
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
    public function searchActive($params)
    {
        $ids = $this->getActiveTasksIdsArray();

        $this->query->where(['in','id',$ids]);

        return $this->search($params, $this->query);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchInactive($params)
    {
        $ids = $this->getInactiveTasksIdsArray();

        $this->query->where(['in','id',$ids]);

        return $this->search($params, $this->query);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchClosed($params)
    {
        $ids = $this->getClosedTasksIdsArray();

        $this->query->where(['in','id',$ids]);

        return $this->search($params, $this->query);
    }



    public function getClosedTasksIdsArray()
    {
        $arIds = [];

        $user = User::find()->where(['id' => Yii::$app->user->id])->one();

        if(!empty($user)) {
            $tasks = $user->closedTasks;

            foreach ($tasks as $task) {
                $arIds[] = $task->id;
            }

            return $arIds;
        }else{
            throw new HttpException(404,'You should login before get tasks.');
        }
    }

    public function getActiveTasksIdsArray()
    {
        $arIds = [];

        $user = User::find()->where(['id' => Yii::$app->user->id])->one();

        if(!empty($user)) {
            $tasks = $user->activeTasks;

            foreach ($tasks as $task) {
                $arIds[] = $task->id;
            }

            return $arIds;
        }else{
            throw new HttpException(404,'You should login before get tasks.');
        }
    }

    public function getInactiveTasksIdsArray()
    {
        $arIds = [];

        $user = User::find()->where(['id' => Yii::$app->user->id])->one();

        if(!empty($user)) {
            $tasks = $user->inactiveTasks;

            foreach ($tasks as $task) {
                $arIds[] = $task->id;
            }

            return $arIds;
        }else{
            throw new HttpException(404,'You should login before get tasks.');
        }
    }


}
