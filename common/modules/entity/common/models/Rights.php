<?php

namespace common\modules\entity\common\models;

use Yii;

/**
 * This is the model class for table "rights".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 *
 * @property RightRoleLink[] $rightRoleLinks
 * @property RightsLang[] $rightsLangs
 */
class Rights extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rights';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('sdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['title', 'code'], 'string'],
            [['code'], 'unique'],
            [['title'], 'unique']
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
            'code' => Yii::t('app', 'Код'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRightRoleLinks()
    {
        return $this->hasMany(RightRoleLink::className(), ['right_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRightsLangs()
    {
        return $this->hasMany(RightsLang::className(), ['main' => 'id']);
    }
}
