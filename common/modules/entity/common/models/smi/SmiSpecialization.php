<?php

namespace common\modules\entity\common\models\smi;

use Yii;

/**
 * This is the model class for table "smi_specialization".
 *
 * @property integer $id
 * @property string $title
 *
 * @property SmiSpecializationLink[] $smiSpecializationLinks
 */
class SmiSpecialization extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_specialization';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiSpecializationLinks()
    {
        return $this->hasMany(SmiSpecializationLink::className(), ['specialization_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SmiSpecializationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiSpecializationQuery(get_called_class());
    }
}
