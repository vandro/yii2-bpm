<?php

namespace common\modules\entity\common\models\smi;

use common\modules\entity\common\models\Languages;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "smi_language_link".
 *
 * @property integer $id
 * @property integer $smi_reestr_id
 * @property integer $language_id
 *
 * @property Languages $language
 * @property SmiReestr $smiReestr
 */
class SmiLanguageLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'smi_language_link';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['smi_reestr_id', 'language_id'], 'required'],
            [['smi_reestr_id', 'language_id'], 'integer']
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
            'language_id' => Yii::t('app', 'Language ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Languages::className(), ['id' => 'language_id']);
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
     * @return SmiLanguageLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SmiLanguageLinkQuery(get_called_class());
    }

    public function getAllLanguage()
    {
        return ArrayHelper::map(Languages::find()->all(), 'id', 'title');
    }
}
