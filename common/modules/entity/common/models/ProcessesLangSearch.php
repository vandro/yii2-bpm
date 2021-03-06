<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\ProcessesLang;

/**
 * ProcessesLangSearch represents the model behind the search form about `common\modules\entity\common\models\ProcessesLang`.
 */
class ProcessesLangSearch extends ProcessesLang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'main'], 'integer'],
            [['lang', 'title'], 'safe'],
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
        $query = ProcessesLang::find();

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
            'main' => $this->main,
        ]);

        $query->andFilterWhere(['like', 'lang', $this->lang])
            ->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
