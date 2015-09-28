<?php

namespace common\modules\entity\common\models\permission;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\permission\UserOrganDepartLink;

/**
 * UserOrganDepartLinkSearch represents the model behind the search form about `common\modules\entity\common\models\permission\UserOrganDepartLink`.
 */
class UserOrganDepartLinkSearch extends UserOrganDepartLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'organisation_id', 'department_id'], 'integer'],
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
        $query = UserOrganDepartLink::find();

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
            'user_id' => $this->user_id,
            'organisation_id' => $this->organisation_id,
            'department_id' => $this->department_id,
        ]);

        return $dataProvider;
    }
}
