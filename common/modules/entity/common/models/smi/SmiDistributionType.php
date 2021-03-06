<?php

namespace common\modules\entity\common\models\smi;

use Yii;

/**
 * This is the model class for table "smi_distribution_type".
 *
 * @property integer $id
 * @property string $title
 *
 * @property SmiReestr[] $smiReestrs
 */
class SmiDistributionType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_distribution_type';
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
    public function getSmiReestrs()
    {
        return $this->hasMany(SmiReestr::className(), ['distribution_type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SmiDistributionTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiDistributionTypeQuery(get_called_class());
    }
}
