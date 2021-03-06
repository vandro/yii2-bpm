<?php

namespace common\modules\entity\common\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "entity_views_lang".
 *
 * @property integer $id
 * @property integer $main
 * @property string $lang
 * @property string $title
 *
 * @property EntityViews $main0
 */
class EntityViewsLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'entity_views_lang';
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
            'id' => Yii::t('app', 'ID'),
            'main' => Yii::t('app', 'Main'),
            'lang' => Yii::t('app', 'Lang'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMain0()
    {
        return $this->hasOne(EntityViews::className(), ['id' => 'main']);
    }
}
