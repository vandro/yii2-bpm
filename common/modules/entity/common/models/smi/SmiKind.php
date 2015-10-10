<?php

namespace common\modules\entity\common\models\smi;

use Yii;

/**
 * This is the model class for table "smi_kind".
 *
 * @property integer $id
 * @property string $title
 *
 * @property SmiReestr[] $smiReestrs
 */
class SmiKind extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_kind';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            'title' => Yii::t('app', 'Наименования'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmiReestrs()
    {
        return $this->hasMany(SmiReestr::className(), ['kind_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SmiKindQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiKindQuery(get_called_class());
    }
}
