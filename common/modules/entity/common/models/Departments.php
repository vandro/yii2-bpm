<?php

namespace common\modules\entity\common\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property integer $id
 * @property string $title
 * @property integer $organisation_id
 * @property string $settings
 *
 * @property Organizations $organisation
 * @property DepartmentsLang[] $departmentsLangs
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
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
            [['title'], 'required'],
            [['title', 'settings'], 'string'],
            [['organisation_id'], 'integer'],
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
            'organisation_id' => Yii::t('app', 'Организация'),
            'settings' => Yii::t('app', 'Настройки'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'organisation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartmentsLangs()
    {
        return $this->hasMany(DepartmentsLang::className(), ['main' => 'id']);
    }
}
