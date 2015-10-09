<?php

namespace common\modules\entity\common\models\smi;

use common\modules\entity\common\models\Cities;
use common\modules\entity\common\models\Regions;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "smi_distribution_region".
 *
 * @property integer $id
 * @property integer $smi_reest_id
 * @property integer $region_id
 * @property integer $city_id
 *
 * @property Cities $city
 * @property SmiReestr $smiReest
 * @property Regions $region
 */
class SmiDistributionRegion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_distribution_region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['smi_reestr_id'], 'required'],
            [['smi_reestr_id', 'region_id', 'city_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'smi_reestr_id' => Yii::t('app', 'Smi Reest ID'),
            'region_id' => Yii::t('app', 'Region ID'),
            'city_id' => Yii::t('app', 'City ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiReestr()
    {
        return $this->hasOne(SmiReestr::className(), ['id' => 'smi_reestr_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
    }

    /**
     * @inheritdoc
     * @return SmiDistributionRegionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiDistributionRegionQuery(get_called_class());
    }

    public function getAllRegions()
    {
        return ArrayHelper::map(Regions::find()->all(), 'id', 'title');
    }

    public function getAllCities()
    {
        return ArrayHelper::map(Cities::find()->where(['region_id' => $this->region_id ])->all(), 'id', 'title');
    }
}
