<?php

namespace common\modules\entity\common\models\smi;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "smi_founders_link".
 *
 * @property integer $id
 * @property integer $smi_reestr_id
 * @property integer $smi_founders_id
 *
 * @property SmiFounders $smiFounders
 * @property SmiReestr $smiReestr
 */
class SmiFoundersLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_founders_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['smi_reestr_id', 'smi_founders_id'], 'required'],
            [['smi_reestr_id', 'smi_founders_id'], 'integer']
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
            'smi_founders_id' => Yii::t('app', 'Smi Founders ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiFounders()
    {
        return $this->hasOne(SmiFounders::className(), ['id' => 'smi_founders_id']);
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
     * @return SmiFoundersLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiFoundersLinkQuery(get_called_class());
    }

    public function getAllFounders()
    {
        return ArrayHelper::map(SmiFounders::find()->all(), 'id', 'title');
    }
}
