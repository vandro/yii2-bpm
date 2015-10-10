<?php

namespace common\modules\epigu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\epigu\models\EpiguAndEntityFieldsLink;

/**
 * EpiguAndEntityFieldsLinkSearch represents the model behind the search form about `common\modules\epigu\models\EpiguAndEntityFieldsLink`.
 */
class EpiguAndEntityFieldsLinkSearch extends EpiguAndEntityFieldsLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'in_action_entity_link_id', 'epigu_service_id', 'epigu_service_field_id', 'entity_type_id', 'entity_type_fields_id'], 'integer'],
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
        $query = EpiguAndEntityFieldsLink::find();

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
            'in_action_entity_link_id' => $this->in_action_entity_link_id,
            'epigu_service_id' => $this->epigu_service_id,
            'epigu_service_field_id' => $this->epigu_service_field_id,
            'entity_type_id' => $this->entity_type_id,
            'entity_type_fields_id' => $this->entity_type_fields_id,
        ]);

        return $dataProvider;
    }
}
