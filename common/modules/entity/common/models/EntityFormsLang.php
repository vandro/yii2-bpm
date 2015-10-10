<?php

namespace common\modules\entity\common\models;

use Yii;

/**
 * This is the model class for table "entity_forms_lang".
 *
 * @property integer $id
 * @property integer $main
 * @property string $lang
 * @property string $title
 *
 * @property EntityForms $main0
 */
class EntityFormsLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_forms_lang';
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
            [['lang', 'title'], 'required'],
            [['main'], 'integer'],
            [['lang', 'title'], 'string'],
            [['title'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'main' => 'Главный',
            'lang' => 'Языки',
            'title' => 'Наименования',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMain0()
    {
        return $this->hasOne(EntityForms::className(), ['id' => 'main']);
    }
}
