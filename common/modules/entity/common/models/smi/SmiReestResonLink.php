<?php

namespace common\modules\entity\common\models\smi;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "smi_reest_reson_link".
 *
 * @property integer $id
 * @property integer $smi_reestr_id
 * @property integer $smi_reason_id
 */
class SmiReestResonLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_reest_reson_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['smi_reestr_id', 'smi_reason_id'], 'required'],
            [['smi_reestr_id', 'smi_reason_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'smi_reestr_id' => Yii::t('app', 'Реестр СМИ'),
            'smi_reason_id' => Yii::t('app', 'Причина СМИ'),
        ];
    }

    /**
     * @inheritdoc
     * @return SmiReestResonLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiReestResonLinkQuery(get_called_class());
    }

    public function getAllReasons()
    {
        return ArrayHelper::map(SmiReasonToOpen::find()->all(), 'id', 'title');
    }
}
