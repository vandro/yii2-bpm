<?php

namespace common\modules\entity\common\models\smi;

use common\modules\entity\common\models\Languages;
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
            [['type_id', 'title'], 'required'],
            [['type_id', 'begin_at', 'frequency_times', 'region_id'], 'integer'],
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
            'title' => Yii::t('app', 'Рўйхатга олинган ОАВнинг номи'),
            'begin_at' => Yii::t('app', 'Чиқа бошлаган даври'),
            'frequency_period' => Yii::t('app', 'Даврийлиги периоди'),
            'frequency_times' => Yii::t('app', 'Даврийлиги мартаси'),
            'region_id' => Yii::t('app', 'Ҳудуд'),
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
    public function getSmiSpecializationLinks()
    {
        return $this->hasMany(SmiSpecializationLink::className(), ['smi_reestr_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiSpecialization()
    {
        return $this->hasMany(SmiSpecialization::className(), ['id' => 'specialization_id'])
            ->via('smiSpecializationLinks');
    }

    public function getSpecializationAdp()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->getSmiSpecialization(),
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

    public function getTypeFilter($searchModel)
    {
        return Html::activeDropDownList($searchModel, 'type_id', $this->getAllTypes(),
            [
                'prompt' => '- Танланг -',
                'class' => 'form-control',
                'style'=>'width: 100px;'
            ]
        );

    }
}
