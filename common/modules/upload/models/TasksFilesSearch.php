<?php

namespace common\modules\upload\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\upload\models\TasksFiles;

/**
 * TasksFilesSearch represents the model behind the search form about `common\modules\upload\models\TasksFiles`.
 */
class TasksFilesSearch extends TasksFiles
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'node_id', 'action_id'], 'integer'],
            [['name', 'ext', 'directoryPath', 'urlPath'], 'safe'],
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
        $query = TasksFiles::find();

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
            'task_id' => $this->task_id,
            'node_id' => $this->node_id,
            'action_id' => $this->action_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'ext', $this->ext])
            ->andFilterWhere(['like', 'directoryPath', $this->directoryPath])
            ->andFilterWhere(['like', 'urlPath', $this->urlPath]);

        return $dataProvider;
    }
}
