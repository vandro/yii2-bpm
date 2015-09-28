<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\ViewsRules;

/**
 * ViewsRulesSearch represents the model behind the search form about `common\modules\entity\common\models\ViewsRules`.
 */
class ViewsRulesSearch extends ViewsRules
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'view_id', 'field_id'], 'integer'],
            [['code', 'value'], 'safe'],
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
        $query = ViewsRules::find();

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
            'view_id' => $this->view_id,
            'field_id' => $this->field_id,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
