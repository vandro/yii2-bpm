<?php

namespace common\modules\entity\common\models;

/**
 * This is the ActiveQuery class for [[Handlers]].
 *
 * @see Handlers
 */
class HandlersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Handlers[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Handlers|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}