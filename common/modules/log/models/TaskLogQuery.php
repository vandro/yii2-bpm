<?php

namespace common\modules\log\models;

/**
 * This is the ActiveQuery class for [[TaskLog]].
 *
 * @see TaskLog
 */
class TaskLogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TaskLog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaskLog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}