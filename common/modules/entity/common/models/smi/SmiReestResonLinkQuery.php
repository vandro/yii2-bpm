<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiReestResonLink]].
 *
 * @see SmiReestResonLink
 */
class SmiReestResonLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiReestResonLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiReestResonLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}