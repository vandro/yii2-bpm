<?php

namespace common\modules\upload\models;

use Yii;

/**
 * This is the model class for table "tasks_files".
 *
 * @property integer $id
 * @property integer $task_id
 * @property integer $node_id
 * @property integer $action_id
 * @property string $name
 * @property string $ext
 * @property string $directoryPath
 * @property string $urlPath
 */
class TasksFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks_files';
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
            [['task_id', 'node_id', 'action_id', 'name', 'ext', 'directoryPath', 'urlPath'], 'required'],
            [['task_id', 'node_id', 'action_id'], 'integer'],
            [['directoryPath', 'urlPath'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['ext'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'task_id' => Yii::t('app', 'Task ID'),
            'node_id' => Yii::t('app', 'Node ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'name' => Yii::t('app', 'Name'),
            'ext' => Yii::t('app', 'Ext'),
            'directoryPath' => Yii::t('app', 'Directory Path'),
            'urlPath' => Yii::t('app', 'Url Path'),
        ];
    }

    /**
     * @inheritdoc
     * @return TasksFilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TasksFilesQuery(get_called_class());
    }
}
