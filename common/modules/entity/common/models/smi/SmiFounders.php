<?php

namespace common\modules\entity\common\models\smi;

use Yii;

/**
 * This is the model class for table "smi_founders".
 *
 * @property integer $id
 * @property string $title
 *
 * @property SmiFoundersLink[] $smiFoundersLinks
 */
class SmiFounders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_founders';
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
    public function getSmiFoundersLinks()
    {
        return $this->hasMany(SmiFoundersLink::className(), ['smi_founders_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SmiFoundersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiFoundersQuery(get_called_class());
    }
}
