<?php

namespace common\modules\entity\common\models\smi;

use common\modules\entity\common\models\Cities;
use common\modules\entity\common\models\Languages;
use common\modules\entity\common\models\Regions;
use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "smi_reestr".
 *
 * @property integer $id
 * @property integer $type_id
 * @property string $title
 * @property integer $begin_at
 * @property string $frequency_period
 * @property integer $frequency_times
 * @property string $address
 * @property string $chief_editor_full_name
 * @property string $phones
 * @property string $certificate_number
 *
 * @property SmiFoundersLink[] $smiFoundersLinks
 * @property SmiLanguageLink[] $smiLanguageLinks
 * @property SmiType $type
 * @property SmiSpecializationLink[] $smiSpecializationLinks
 * @property SmiTypeLink[] $smiTypeLinks
 */
class SmiReestr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_reestr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_id', 'kind_id', 'title', 'national', 'state'], 'required'],
            [['type_id', 'kind_id', 'begin_at', 'frequency_times', 'region_id', 'city_id', 'national', 'state', 'distribution_type_id'], 'integer'],
            [['frequency_period', 'address', 'phones'], 'string'],
            [['title', 'chief_editor_full_name', 'certificate_number'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type_id' => Yii::t('app', 'ОАВнинг тури'),
            'kind_id' => Yii::t('app', 'ОАВнинг фалият куриниши'),
            'national' => Yii::t('app', 'Давлатга қарашли бўлган'),
            'title' => Yii::t('app', 'Рўйхатга олинган ОАВнинг номи'),
            'begin_at' => Yii::t('app', 'Чиқа бошлаган даври'),
            'state' => Yii::t('app', 'Холати'),
            'frequency_period' => Yii::t('app', 'Даврийлиги периоди'),
            'frequency_times' => Yii::t('app', 'Даврийлиги мартаси'),
            'distribution_type_id' => Yii::t('app', 'Тарқатиш усули'),
            'region_id' => Yii::t('app', 'Ҳудуд'),
            'city_id' => Yii::t('app', 'Шахар'),
            'address' => Yii::t('app', 'Таҳририят манзили'),
            'chief_editor_full_name' => Yii::t('app', 'Бош муҳаррир фамилияси, исми, шарифи'),
            'phones' => Yii::t('app', 'Бош муҳаррир телефонлари'),
            'certificate_number' => Yii::t('app', 'Гувоҳнома рақами'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiFoundersLinks()
    {
        return $this->hasMany(SmiFoundersLink::className(), ['smi_reestr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiFounders()
    {
        return $this->hasMany(SmiFounders::className(), ['id' => 'smi_founders_id'])
            ->via('smiFoundersLinks');
    }

    public function getFoundersAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getSmiFounders(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiLanguageLinks()
    {
        return $this->hasMany(SmiLanguageLink::className(), ['smi_reestr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguages()
    {
        return $this->hasMany(Languages::className(), ['id' => 'language_id'])
            ->via('smiLanguageLinks');
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getLanguagesAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getLanguages(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(SmiType::className(), ['id' => 'type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKind()
    {
        return $this->hasOne(SmiKind::className(), ['id' => 'kind_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'region_id']);
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
    public function getSmiSpecializationLinks()
    {
        return $this->hasMany(SmiSpecializationLink::className(), ['smi_reestr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiReasonLinks()
    {
        return $this->hasMany(SmiReestResonLink::className(), ['smi_reestr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiSpecialization()
    {
        return $this->hasMany(SmiSpecialization::className(), ['id' => 'specialization_id'])
            ->via('smiSpecializationLinks');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiReasons()
    {
        return $this->hasMany(SmiReasonToOpen::className(), ['id' => 'smi_reason_id'])
            ->via('smiReasonLinks');
    }

    public function getSpecializationAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getSmiSpecialization(),
        ]);

        return $dataProvider;
    }

    public function getReasonsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getSmiReasons(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiDistributionRegionsLinks()
    {
        return $this->hasMany(SmiDistributionRegion::className(), ['smi_reestr_id' => 'id']);
    }

    public function getDistributionRegionsAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getSmiDistributionRegionsLinks(),
        ]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiTypeLinks()
    {
        return $this->hasMany(SmiTypeLink::className(), ['smi_reestr_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SmiReestrQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiReestrQuery(get_called_class());
    }

    public function getAllTypes()
    {
        return ArrayHelper::map(SmiType::find()->all(), 'id', 'title');
    }

    public function getAllKinds()
    {
        return ArrayHelper::map(SmiKind::find()->all(), 'id', 'title');
    }

    public function getAllRegions()
    {
        return ArrayHelper::map(Regions::find()->all(), 'id', 'title');
    }

    public function getAllCities()
    {
        return ArrayHelper::map(Cities::find()->where(['region_id' => $this->region_id ])->all(), 'id', 'title');
    }

    public function getTypeFilter($searchModel)
    {
        return Html::activeDropDownList($searchModel, 'type_id', $this->getAllTypes(),
            [
                'prompt' => '- Танланг -',
                'class' => 'form-control',
                'style'=>'width: 200px;'
            ]
        );

    }

    public function getDistributionType()
    {
        return $this->hasOne(SmiDistributionType::className(), ['id' => 'distribution_type_id']);
    }

    public function getAllDistributionType()
    {
        return ArrayHelper::map(SmiDistributionType::find()->all(), 'id', 'title');
    }
}
