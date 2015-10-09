<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiDistributionType]].
 *
 * @see SmiDistributionType
 */
class SmiDistributionTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiDistributionType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiDistributionType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}