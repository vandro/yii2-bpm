<?php

namespace common\modules\entity\common\models;

use common\modules\entity\common\config\Config;
use Yii;

/**
 * This is the model class for table "tasks_entities_link".
 *
 * @property integer $id
 * @property integer $task_id
 * @property integer $entity_id
 * @property integer $entity_item_id
 * @property integer $user_id
 * @property string $created_at
 */
class TasksEntitiesLink extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks_entities_link';
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
            [['task_id', 'entity_id', 'entity_item_id', 'user_id'], 'required'],
            [['task_id', 'entity_id', 'entity_item_id', 'user_id'], 'integer'],
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
            'task_id' => Yii::t('app', 'Task ID'),
            'entity_id' => Yii::t('app', 'Entity ID'),
            'entity_item_id' => Yii::t('app', 'Entity Item ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    public function getEntity()
    {
        $entity = Yii::$app->modules[Config::MODULE_NAME]->entityFactory->get($action);
    }
}
