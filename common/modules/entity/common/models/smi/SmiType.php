<?php

namespace common\modules\entity\common\models\smi;

use Yii;

/**
 * This is the model class for table "smi_type".
 *
 * @property integer $id
 * @property string $title
 *
 * @property SmiTypeLink[] $smiTypeLinks
 */
class SmiType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_type';
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
    public function getSmiTypeLinks()
    {
        return $this->hasMany(SmiTypeLink::className(), ['smi_type_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SmiTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiTypeQuery(get_called_class());
    }

    public function getSmi()
    {
        return $this->hasMany(SmiReestr::className(),['type_id' => 'id']);
    }
}
