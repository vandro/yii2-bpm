<?php

namespace common\modules\entity\common\models\permission;

use common\modules\entity\common\models\Departments;
use common\modules\entity\common\models\Processes;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "process_organ_depart_link".
 *
 * @property integer $id
 * @property integer $process_id
 * @property integer $organisation_id
 * @property integer $first_department_id
 *
 * @property Departments $firstDepartment
 * @property Organizations $organisation
 * @property Processes $process
 */
class ProcessOrganDepartLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'process_organ_depart_link';
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
            [['process_id', 'organisation_id', 'first_department_id'], 'required'],
            [['process_id', 'organisation_id', 'first_department_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'process_id' => Yii::t('app', 'Process ID'),
            'organisation_id' => Yii::t('app', 'Organisation ID'),
            'first_department_id' => Yii::t('app', 'First Department ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFirstDepartment()
    {
        return $this->hasOne(Departments::className(), ['id' => 'first_department_id']);
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
    public function getProcess()
    {
        return $this->hasOne(Processes::className(), ['id' => 'process_id']);
    }

    /**
     * @inheritdoc
     * @return ProcessOrganDepartLinkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProcessOrganDepartLinkQuery(get_called_class());
    }

    public function getAllProcess()
    {
        return ArrayHelper::map(Processes::find()->all(),  'id', 'title');
    }

    public function getAllDepartments()
    {
        return !empty($this->organisation_id)?ArrayHelper::map(Departments::find()->where(['organisation_id' => $this->organisation_id])->all(), 'id', 'title'):[];
    }
}
