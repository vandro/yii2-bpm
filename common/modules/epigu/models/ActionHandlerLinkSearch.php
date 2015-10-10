<?php

namespace common\modules\epigu\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\epigu\models\ActionHandlerLink;

/**
 * ActionHandlerLinkSearch represents the model behind the search form about `common\modules\epigu\models\ActionHandlerLink`.
 */
class ActionHandlerLinkSearch extends ActionHandlerLink
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'action_id', 'handler_id'], 'integer'],
            [['settings', 'type'], 'safe'],
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
        $query = ActionHandlerLink::find();

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
            'action_id' => $this->action_id,
            'handler_id' => $this->handler_id,
        ]);

        $query->andFilterWhere(['like', 'settings', $this->settings])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
