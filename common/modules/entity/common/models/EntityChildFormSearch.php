<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\entity\common\models\EntityChildForm;

/**
 * EntityChildFormSearch represents the model behind the search form about `common\modules\entity\common\models\EntityChildForm`.
 */
class EntityChildFormSearch extends EntityChildForm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'entity_type_id', 'widget', 'added'], 'integer'],
            [['parent_form_id', 'foreign_key_field_id', 'title', 'code', 'options', 'html', 'mode'], 'safe'],
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
        $query = EntityChildForm::find();

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
            'entity_type_id' => $this->entity_type_id,
            'widget' => $this->widget,
            'added' => $this->added,
        ]);

        $query->andFilterWhere(['like', 'parent_form_id', $this->parent_form_id])
            ->andFilterWhere(['like', 'foreign_key_field_id', $this->foreign_key_field_id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'options', $this->options])
            ->andFilterWhere(['like', 'html', $this->html])
            ->andFilterWhere(['like', 'mode', $this->mode]);

        return $dataProvider;
    }
}
