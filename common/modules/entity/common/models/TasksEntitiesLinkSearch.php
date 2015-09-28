<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\TasksEntitiesLink;

/**
 * TasksEntitiesLinkSearch represents the model behind the search form about `common\modules\entity\common\models\TasksEntitiesLink`.
 */
class TasksEntitiesLinkSearch extends TasksEntitiesLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'task_id', 'entity_id', 'entity_item_id', 'user_id'], 'integer'],
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
        $query = TasksEntitiesLink::find();

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
            'entity_id' => $this->entity_id,
            'entity_item_id' => $this->entity_item_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
