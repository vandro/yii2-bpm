<?php

namespace common\modules\entity\common\models\permission;

/**
 * This is the ActiveQuery class for [[UserOrganDepartLink]].
 *
 * @see UserOrganDepartLink
 */
class UserOrganDepartLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return UserOrganDepartLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return UserOrganDepartLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}