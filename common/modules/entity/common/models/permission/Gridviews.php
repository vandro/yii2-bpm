<?php

namespace common\modules\entity\common\models\permission;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "gridviews".
 *
 * @property integer $id
 * @property string $title
 * @property integer $user_id
 * @property integer $default
 *
 * @property GridviewFields[] $gridviewFields
 */
class Gridviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gridviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'user_id'], 'required'],
            [['user_id', 'default'], 'integer'],
            [['title'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Наименования'),
            'user_id' => Yii::t('app', 'Ползователь'),
            'default' => Yii::t('app', 'По умолчанию'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGridviewFields()
    {
        return $this->hasMany(GridviewFields::className(), ['gridview_id' => 'id']);
    }

    public function getFields()
    {
        return $this->hasMany(GridviewFields::className(), ['gridview_id' => 'id']);
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
            'query' => $this->getGridviewFields(),
        ]);

        return $dataProvider;
    }

    /**
     * @inheritdoc
     * @return GridviewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GridviewsQuery(get_called_class());
    }


}
