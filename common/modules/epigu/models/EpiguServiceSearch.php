<?php

namespace common\modules\epigu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\epigu\models\EpiguService;

/**
 * EpiguServiceSearch represents the model behind the search form about `common\modules\epigu\models\EpiguService`.
 */
class EpiguServiceSearch extends EpiguService
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'epugi_id'], 'integer'],
            [['title', 'code'], 'safe'],
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
        $query = EpiguService::find();

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
            'epugi_id' => $this->epugi_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }
}
