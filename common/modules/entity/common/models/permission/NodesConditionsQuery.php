<?php

namespace common\modules\entity\common\models\permission;

/**
 * This is the ActiveQuery class for [[NodesConditions]].
 *
 * @see NodesConditions
 */
class NodesConditionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return NodesConditions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return NodesConditions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}