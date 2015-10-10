<?php

namespace common\modules\log\models;

use common\modules\entity\common\models\NodesActions;
use common\modules\entity\common\models\permission\User;
use common\modules\entity\common\models\Processes;
use common\modules\entity\common\models\ProcessNodes;
use common\modules\entity\common\models\TasksCart;
use Yii;

/**
 * This is the model class for table "task_log".
 *
 * @property integer $id
 * @property string $log_at
 * @property integer $process_id
 * @property integer $task_id
 * @property integer $node_id
 * @property integer $action_id
 * @property integer $user_id
 */
class TaskLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_log';
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
            [['log_at'], 'safe'],
            [['process_id', 'task_id', 'node_id', 'action_id', 'user_id'], 'required'],
            [['process_id', 'task_id', 'node_id', 'action_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'log_at' => Yii::t('app', 'Дата'),
            'process_id' => Yii::t('app', 'Процесс'),
            'task_id' => Yii::t('app', 'Задача'),
            'node_id' => Yii::t('app', 'Шаг'),
            'action_id' => Yii::t('app', 'Действие'),
            'user_id' => Yii::t('app', 'Пользователь'),
        ];
    }

    /**
     * @inheritdoc
     * @return TaskLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TaskLogQuery(get_called_class());
    }

    public function getProcess()
    {
        return $this->hasOne(Processes::className(), ['id' => 'process_id']);
    }

    public function getTask()
    {
        return $this->hasOne(TasksCart::className(), ['id' => 'task_id']);
    }

    public function getNode()
    {
        return $this->hasOne(ProcessNodes::className(), ['id' => 'node_id']);
    }

    public function getAction()
    {
        return $this->hasOne(NodesActions::className(), ['id' => 'action_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
