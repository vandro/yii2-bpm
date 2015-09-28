<?php

namespace common\modules\entity\common\models\permission;

use common\modules\entity\common\config\Config;
use common\modules\entity\common\models\Departments;
use common\modules\entity\common\models\Organizations;
use common\modules\entity\common\models\Processes;
use Yii;

/**
 * This is the model class for table "tasks_cart".
 *
 * @property integer $id
 * @property integer $process_id
 * @property integer $organisation_id
 * @property integer $department_id
 * @property integer $author_id
 * @property integer $assigned_to_id
 * @property integer $current_node_id
 * @property integer $active
 * @property string $created_at
 */
class ComplexTasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks_cart';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('pdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['process_id', 'author_id', 'current_node_id'], 'required'],
            [['process_id', 'organisation_id', 'department_id', 'author_id', 'current_node_id', 'active', 'assigned_to_id'], 'integer'],
            [['created_at'], 'safe']
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
            'department_id' => Yii::t('app', 'Department ID'),
            'author_id' => Yii::t('app', 'Author ID'),
            'assigned_to_id' => Yii::t('app', 'Assigned to ID'),
            'current_node_id' => Yii::t('app', 'Current Node ID'),
            'active' => Yii::t('app', 'Active'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     * @return TasksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcess()
    {
        return $this->hasOne(Processes::className(), ['id' => 'process_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organizations::className(), ['id' => 'organisation_id']);
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
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentNode()
    {
        return $this->hasOne(Nodes::className(), ['id' => 'current_node_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAssignedTo()
    {
        return $this->hasOne(User::className(), ['id' => 'assigned_to_id']);
    }
}
