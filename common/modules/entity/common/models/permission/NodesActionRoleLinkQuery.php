<?php

namespace common\modules\entity\common\models\permission;

/**
 * This is the ActiveQuery class for [[NodesActionRoleLink]].
 *
 * @see NodesActionRoleLink
 */
class NodesActionRoleLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return NodesActionRoleLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return NodesActionRoleLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}