<?php

namespace common\modules\entity\common\models;

use common\modules\entity\common\models\smi\SmiReestr;
use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "regions".
 *
 * @property integer $id
 * @property string $title
 * @property integer $order
 */
class Regions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order'], 'integer'],
            [['title'], 'string', 'max' => 255]
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
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * @inheritdoc
     * @return RegionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegionsQuery(get_called_class());
    }

    public function getCities()
    {
        return $this->hasMany(Cities::className(),['region_id' => 'id']);
    }

    public function getSmi()
    {
        return $this->hasMany(SmiReestr::className(),['region_id' => 'id']);
    }

    public function getCitiesAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getCities(),
        ]);

        return $dataProvider;
    }
}
