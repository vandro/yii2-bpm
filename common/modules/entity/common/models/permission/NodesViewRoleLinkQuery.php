<?php

namespace common\modules\entity\common\models\permission;
use common\helpers\DebugHelper;

/**
 * This is the ActiveQuery class for [[NodesViewRoleLink]].
 *
 * @see NodesViewRoleLink
 */
class NodesViewRoleLinkQuery extends \yii\db\ActiveQuery
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

    public function notIn($roles)
    {
        $arRolesIds = [];
        foreach($roles as $role){
            $arRolesIds[] = $role->id;
        }
        $this->andWhere(['not in', 'role_id', $arRolesIds]);
        return $this;
    }

    public function active()
    {
        $this->joinWith(['node' => function ($q) {
            $q->where('process_nodes.order_status IS NOT "last"'); // OR process_nodes.order_status IS NOT "approved_last" OR process_nodes.order_status IS NOT "rejected_last"');
        }]);
        return $this;
    }

    public function last()
    {
        $this->joinWith(['node' => function ($q) {
            $q->where('process_nodes.order_status = "last"'); // OR process_nodes.order_status = "approved_last" OR process_nodes.order_status = "rejected_last"');
        }]);
        return $this;
    }

    /**
     * @inheritdoc
     * @return NodesViewRoleLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return NodesViewRoleLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}