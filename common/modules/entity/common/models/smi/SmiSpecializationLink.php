<?php

namespace common\modules\entity\common\models\smi;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "smi_specialization_link".
 *
 * @property integer $id
 * @property integer $smi_reestr_id
 * @property integer $specialization_id
 *
 * @property SmiSpecialization $specialization
 * @property SmiReestr $smiReestr
 */
class SmiSpecializationLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_specialization_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['smi_reestr_id', 'specialization_id'], 'required'],
            [['smi_reestr_id', 'specialization_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'smi_reestr_id' => Yii::t('app', 'Smi Reestr ID'),
            'specialization_id' => Yii::t('app', 'Specialization ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialization()
    {
        return $this->hasOne(SmiSpecialization::className(), ['id' => 'specialization_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiReestr()
    {
        return $this->hasOne(SmiReestr::className(), ['id' => 'smi_reestr_id']);
    }

    /**
     * @inheritdoc
     * @return SmiSpecializationLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiSpecializationLinkQuery(get_called_class());
    }

    public function getAllSpecializations()
    {
        return ArrayHelper::map(SmiSpecialization::find()->all(), 'id', 'title');
    }
}
