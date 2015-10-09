<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiSpecializationLink]].
 *
 * @see SmiSpecializationLink
 */
class SmiSpecializationLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiSpecializationLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiSpecializationLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}