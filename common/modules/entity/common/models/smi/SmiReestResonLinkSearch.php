<?php

namespace common\modules\entity\common\models\smi;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\smi\SmiReestResonLink;

/**
 * SmiReestResonLinkSearch represents the model behind the search form about `common\modules\entity\common\models\smi\SmiReestResonLink`.
 */
class SmiReestResonLinkSearch extends SmiReestResonLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'smi_reestr_id', 'smi_reason_id'], 'integer'],
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
        $query = SmiReestResonLink::find();

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
            'smi_reestr_id' => $this->smi_reestr_id,
            'smi_reason_id' => $this->smi_reason_id,
        ]);

        return $dataProvider;
    }
}
