<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiDistributionRegion]].
 *
 * @see SmiDistributionRegion
 */
class SmiDistributionRegionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiDistributionRegion[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiDistributionRegion|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}