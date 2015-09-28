<?php

namespace common\modules\entity\common\models\permission;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\permission\ProcessOrganDepartLink;

/**
 * ProcessOrganDepartLinkSearch represents the model behind the search form about `common\modules\entity\common\models\permission\ProcessOrganDepartLink`.
 */
class ProcessOrganDepartLinkSearch extends ProcessOrganDepartLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'process_id', 'organisation_id', 'first_department_id'], 'integer'],
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
        $query = ProcessOrganDepartLink::find();

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
            'process_id' => $this->process_id,
            'organisation_id' => $this->organisation_id,
            'first_department_id' => $this->first_department_id,
        ]);

        return $dataProvider;
    }
}
