<?php

namespace common\modules\entity\common\models;

use Yii;

/**
 * This is the model class for table "entity_types_lang".
 *
 * @property integer $id
 * @property integer $main
 * @property string $lang
 * @property string $title
 *
 * @property EntityTypes $main0
 */
class EntityTypesLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_types_lang';
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
            [['lang', 'title'], 'string']
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
    public function getMain()
    {
        return $this->hasOne(EntityTypes::className(), ['id' => 'main']);
    }
}
