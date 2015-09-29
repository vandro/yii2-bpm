<?php

namespace common\modules\entity\common\models\smi;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\smi\SmiReestr;

/**
 * SmiReestrSearch represents the model behind the search form about `common\modules\entity\common\models\smi\SmiReestr`.
 */
class SmiReestrSearch extends SmiReestr
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'begin_at', 'frequency_times'], 'integer'],
            [['title','type_id', 'frequency_period', 'address', 'chief_editor_full_name', 'phones', 'certificate_number'], 'safe'],
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
        $query = SmiReestr::find();

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
            'type_id' => $this->type_id,
            //'region_id' => $this->region_id,
            'begin_at' => $this->begin_at,
            'frequency_times' => $this->frequency_times,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'frequency_period', $this->frequency_period])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'chief_editor_full_name', $this->chief_editor_full_name])
            ->andFilterWhere(['like', 'phones', $this->phones])
            ->andFilterWhere(['like', 'certificate_number', $this->certificate_number]);

        return $dataProvider;
    }
}
