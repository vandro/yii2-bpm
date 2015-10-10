<?php

namespace common\modules\epigu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\epigu\models\EpiguServiceFileds;

/**
 * EpiguServiceFiledsSearch represents the model behind the search form about `common\modules\epigu\models\EpiguServiceFileds`.
 */
class EpiguServiceFiledsSearch extends EpiguServiceFileds
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'epigu_service_id', 'epigu_fileld_id', 'has_group', 'has_dependents', 'is_default', 'disabled', 'step', 'inResult'], 'integer'],
            [['name', 'group', 'label_ru', 'label_uz', 'label_en', 'description_ru', 'description_uz', 'description_en', 'type', 'depend', 'defaultValue', 'api', 'validators', 'mode'], 'safe'],
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
        $query = EpiguServiceFileds::find();

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
            'epigu_service_id' => $this->epigu_service_id,
            'epigu_fileld_id' => $this->epigu_fileld_id,
            'has_group' => $this->has_group,
            'has_dependents' => $this->has_dependents,
            'is_default' => $this->is_default,
            'disabled' => $this->disabled,
            'step' => $this->step,
            'inResult' => $this->inResult,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'group', $this->group])
            ->andFilterWhere(['like', 'label_ru', $this->label_ru])
            ->andFilterWhere(['like', 'label_uz', $this->label_uz])
            ->andFilterWhere(['like', 'label_en', $this->label_en])
            ->andFilterWhere(['like', 'description_ru', $this->description_ru])
            ->andFilterWhere(['like', 'description_uz', $this->description_uz])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'depend', $this->depend])
            ->andFilterWhere(['like', 'defaultValue', $this->defaultValue])
            ->andFilterWhere(['like', 'api', $this->api])
            ->andFilterWhere(['like', 'validators', $this->validators])
            ->andFilterWhere(['like', 'mode', $this->mode]);

        return $dataProvider;
    }
}
