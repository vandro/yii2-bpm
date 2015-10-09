<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiFoundersLink]].
 *
 * @see SmiFoundersLink
 */
class SmiFoundersLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiFoundersLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiFoundersLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}