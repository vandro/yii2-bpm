<?php

namespace common\modules\entity\common\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property integer $process_id
 * @property integer $author_id
 * @property integer $current_node_id
 * @property string $created_at
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
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
            [['process_id', 'author_id', 'current_node_id'], 'integer'],
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
            'process_id' => Yii::t('app', 'Процесс'),
            'author_id' => Yii::t('app', 'Автор'),
            'current_node_id' => Yii::t('app', 'Текущий шаг'),
            'created_at' => Yii::t('app', 'Дата добавлено'),
        ];
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
    public function getCurrentNode()
    {
        return $this->hasOne(ProcessNodes::className(), ['id' => 'current_node_id']);
    }
}
