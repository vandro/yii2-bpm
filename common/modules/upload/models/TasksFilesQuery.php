<?php

namespace common\modules\upload\models;

/**
 * This is the ActiveQuery class for [[TasksFiles]].
 *
 * @see TasksFiles
 */
class TasksFilesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TasksFiles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TasksFiles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}