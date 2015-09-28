<?php

namespace common\modules\entity\common\models\permission;

/**
 * This is the ActiveQuery class for [[RightRoleLink]].
 *
 * @see RightRoleLink
 */
class RightRoleLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    public function in($roles)
    {
        $arRolesIds = [];
        foreach($roles as $role){
            $arRolesIds[] = $role->id;
        }
        $this->andWhere(['in', 'role_id', $arRolesIds]);
        return $this;
    }

    /**
     * @inheritdoc
     * @return RightRoleLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RightRoleLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}