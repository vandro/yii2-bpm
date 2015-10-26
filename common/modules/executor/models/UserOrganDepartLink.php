<?php

namespace common\modules\executor\models;

use Yii;

/**
 * This is the model class for table "user_organ_depart_link".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $organisation_id
 * @property integer $department_id
 *
 * @property Departments $department
 * @property Organizations $organisation
 */
class UserOrganDepartLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_organ_depart_link';
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
            [['user_id', 'organisation_id', 'department_id'], 'required'],
            [['user_id', 'organisation_id', 'department_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'organisation_id' => Yii::t('app', 'Organisation ID'),
            'department_id' => Yii::t('app', 'Department ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganisation()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'organisation_id']);
    }
}
