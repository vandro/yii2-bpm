<?php

namespace common\modules\entity\common\models\permission;

/**
 * This is the ActiveQuery class for [[Nodes]].
 *
 * @see Nodes
 */
class NodesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

//   public function in($roles)
//   {
//       $arRolesIds = [];
//       foreach($roles as $role){
//           $arRolesIds[] = $role->id;
//       }
//       $this->andWhere(['in', 'id', $arRolesIds]);
//       return $this;
//   }

//->where(['order_status' => 'last'])

    /**
     * @inheritdoc
     * @return Nodes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Nodes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}