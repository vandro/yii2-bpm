<?php

namespace common\modules\entity\common\models;

use common\helpers\DebugHelper;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\TasksCart;
use common\modules\entity\common\models\User;

/**
 * TasksCartSearch represents the model behind the search form about `common\modules\entity\common\models\TasksCart`.
 */
class TasksCartSearch extends TasksCart
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'process_id', 'author_id', 'current_node_id'], 'integer'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TasksCart::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'process_id' => $this->process_id,
            'author_id' => Yii::$app->user->id,
            'current_node_id' => $this->current_node_id,
            'created_at' => $this->created_at,
        ]);

        $query->orderBy('id desc');

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
        $query = TasksCart::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $ids = $this->getActiveTasksIdsArray();

        $query->where(['in','id',$ids]);

        $query->andFilterWhere([
            'id' => $this->id,
            'process_id' => $this->process_id,
            'author_id' => Yii::$app->user->id,
            'current_node_id' => $this->current_node_id,
            'created_at' => $this->created_at,
        ]);

        $query->orderBy('id desc');

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchInActive($params)
    {
        $query = TasksCart::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $ids = $this->getActiveTasksIdsArray();

        $query->where(['not in','id',$ids]);

        $query->andFilterWhere([
            'id' => $this->id,
            'process_id' => $this->process_id,
            'author_id' => Yii::$app->user->id,
            'current_node_id' => $this->current_node_id,
            'created_at' => $this->created_at,
        ]);

        $query->orderBy('id desc');

        return $dataProvider;
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
        $query = TasksCart::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $ids = $this->getClosedTasksIdsArray();

        $query->where(['in','id',$ids]);

        $query->andFilterWhere([
            'id' => $this->id,
            'process_id' => $this->process_id,
            'author_id' => Yii::$app->user->id,
            'current_node_id' => $this->current_node_id,
            'created_at' => $this->created_at,
        ]);

        $query->orderBy('id desc');

        return $dataProvider;
    }


    public function getActiveTasksIdsArray()
    {
        $arIds = [];
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        $tasks = $user->roleModel->tasks;

        foreach($tasks as $task){
            $arIds[] = $task->id;
        }

        return $arIds;
    }

    public function getClosedTasksIdsArray()
    {
        $arIds = [];
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        $tasks = $user->roleModel->tasksInLastNode;

        foreach($tasks as $task){
            $arIds[] = $task->id;
        }

        return $arIds;
    }
}
