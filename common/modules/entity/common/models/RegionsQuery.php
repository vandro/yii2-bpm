<?php

namespace common\modules\entity\common\models;

/**
 * This is the ActiveQuery class for [[Regions]].
 *
 * @see Regions
 */
class RegionsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Regions[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Regions|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}