<?php

namespace common\modules\entity\common\models\permission;

/**
 * This is the ActiveQuery class for [[UserRoleLinks]].
 *
 * @see UserRoleLinks
 */
class UserRoleLinksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserRoleLinks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserRoleLinks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}