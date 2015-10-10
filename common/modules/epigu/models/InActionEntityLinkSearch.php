<?php

namespace common\modules\epigu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\epigu\models\InActionEntityLink;

/**
 * InActionEntityLinkSearch represents the model behind the search form about `common\modules\epigu\models\InActionEntityLink`.
 */
class InActionEntityLinkSearch extends InActionEntityLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'integration_action_id', 'entity_type_id'], 'integer'],
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
        $query = InActionEntityLink::find();

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
            'integration_action_id' => $this->integration_action_id,
            'entity_type_id' => $this->entity_type_id,
        ]);

        return $dataProvider;
    }
}
