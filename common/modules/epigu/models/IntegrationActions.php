<?php

namespace common\modules\epigu\models;

use common\modules\entity\common\models\Processes;
use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "integration_actions".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property integer $process_id
 *
 * @property InActionEntityLink[] $inActionEntityLinks
 */
class IntegrationActions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'integration_actions';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('edb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['title', 'code'], 'string'],
            [['process_id'], 'integer'],
            [['code'], 'unique'],
            [['title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
            'process_id' => Yii::t('app', 'Process ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInActionEntityLinks()
    {
        return $this->hasMany(InActionEntityLink::className(), ['integration_action_id' => 'id']);
    }

    public function getInActionEntityLinksAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getInActionEntityLinks(),
        ]);

        return $dataProvider;
    }

    /**
     * @inheritdoc
     * @return IntegrationActionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IntegrationActionsQuery(get_called_class());
    }

    public function getAllProcess()
    {
        return ArrayHelper::map(Processes::find()->all(), 'id', 'title');
    }

    public function getProcess()
    {
        return $this->hasOne(Processes::className(),['id' => 'process_id']);
    }

    public function getConditionActions()
    {
        return $this->hasMany(ConditionsActions::className(), ['integration_action_id' => 'id']);
    }

    public function getConditionActionsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getConditionActions(),
        ]);

        return $dataProvider;
    }
}
