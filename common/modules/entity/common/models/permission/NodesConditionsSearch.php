<?php

namespace common\modules\entity\common\models\permission;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\permission\NodesConditions;

/**
 * NodesConditionsSearch represents the model behind the search form about `common\modules\entity\common\models\permission\NodesConditions`.
 */
class NodesConditionsSearch extends NodesConditions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'true_action_id', 'false_action_id', 'true_condition_id', 'false_condition_id', 'operand_1_entity_id', 'operand_1_field_id'], 'integer'],
            [['next_execution_type', 'operator', 'operand_2'], 'safe'],
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
        $query = NodesConditions::find();

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
            'true_action_id' => $this->true_action_id,
            'false_action_id' => $this->false_action_id,
            'true_condition_id' => $this->true_condition_id,
            'false_condition_id' => $this->false_condition_id,
            'operand_1_entity_id' => $this->operand_1_entity_id,
            'operand_1_field_id' => $this->operand_1_field_id,
        ]);

        $query->andFilterWhere(['like', 'next_execution_type', $this->next_execution_type])
            ->andFilterWhere(['like', 'operator', $this->operator])
            ->andFilterWhere(['like', 'operand_2', $this->operand_2]);

        return $dataProvider;
    }
}
