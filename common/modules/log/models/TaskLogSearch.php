<?php

namespace common\modules\log\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\log\models\TaskLog;

/**
 * TaskLogSearch represents the model behind the search form about `common\modules\log\models\TaskLog`.
 */
class TaskLogSearch extends TaskLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'process_id', 'task_id', 'node_id', 'action_id', 'user_id'], 'integer'],
            [['log_at'], 'safe'],
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
        $query = TaskLog::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'log_at' => $this->log_at,
            'process_id' => $this->process_id,
            'task_id' => $this->task_id,
            'node_id' => $this->node_id,
            'action_id' => $this->action_id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
