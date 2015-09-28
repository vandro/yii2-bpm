<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * This is the model class for table "entity_types".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property integer $added
 *
 * @property EntityFields[] $entityFields
 * @property EntityFields[] $entityFields0
 * @property EntityFildsLang[] $entityFildsLangs
 * @property EntityForms[] $entityForms
 * @property EntityFormsLang[] $entityFormsLangs
 * @property EntityTypesLang[] $entityTypesLangs
 * @property EntityViews[] $entityViews
 * @property EntityViewsLang[] $entityViewsLangs
 * @property FormsRules[] $formsRules
 * @property ViewsRules[] $viewsRules
 */
class EntityTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_types';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('sdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['title', 'code'], 'string'],
            [['added'], 'integer'],
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
            'id' => 'ID',
            'title' => 'Title',
            'code' => 'Code',
            'added' => 'Added',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFields()
    {
        return $this->hasMany(EntityFields::className(), ['entity_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getFieldsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getFields(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForms()
    {
        return $this->hasMany(EntityForms::className(), ['entity_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getFormsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getForms(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(EntityTypesLang::className(), ['main' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getLangsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getLangs(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViews()
    {
        return $this->hasMany(EntityViews::className(), ['entity_id' => 'id']);
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getViewsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getViews(),
        ]);

        return $dataProvider;
    }
}
