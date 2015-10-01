<?php

namespace common\modules\entity\common\models\smi;

use Yii;

/**
 * This is the model class for table "smi_begin_at_dates".
 *
 * @property integer $begin_at
 */
class SmiBeginAtDates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_begin_at_dates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['begin_at'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'begin_at' => Yii::t('app', 'Чиқа бошлаган даври'),
        ];
    }

    /**
     * @inheritdoc
     * @return SmiBeginAtDatesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiBeginAtDatesQuery(get_called_class());
    }
}
