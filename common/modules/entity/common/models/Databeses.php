<?php

namespace common\modules\entity\common\models;

use Yii;

/**
 * This is the model class for table "databeses".
 *
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property string $settings
 *
 * @property EntityTypes[] $entityTypes
 */
class Databeses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'databeses';
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
            [['title', 'code', 'settings'], 'string'],
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
            'title' => Yii::t('app', 'Title'),
            'code' => Yii::t('app', 'Code'),
            'settings' => Yii::t('app', 'Settings'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntityTypes()
    {
        return $this->hasMany(EntityTypes::className(), ['database_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return DatabesesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DatabesesQuery(get_called_class());
    }

    public function getTitleForDD()
    {
        return $this->title.' ('.$this->code.')';
    }
}
