<?php

namespace common\modules\entity\common\models\permission;

/**
 * This is the ActiveQuery class for [[Gridviews]].
 *
 * @see Gridviews
 */
class GridviewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Gridviews[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Gridviews|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}