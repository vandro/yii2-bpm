<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\NodeViewRoleLink;

/**
 * NodeViewRoleLinkSearch represents the model behind the search form about `common\modules\entity\common\models\NodeViewRoleLink`.
 */
class NodeViewRoleLinkSearch extends NodeViewRoleLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'node_id', 'view_id', 'role_id'], 'integer'],
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
        $query = NodeViewRoleLink::find();

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
            'node_id' => $this->node_id,
            'view_id' => $this->view_id,
            'role_id' => $this->role_id,
        ]);

        return $dataProvider;
    }
}
