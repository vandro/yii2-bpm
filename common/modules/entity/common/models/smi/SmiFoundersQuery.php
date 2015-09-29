<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiFounders]].
 *
 * @see SmiFounders
 */
class SmiFoundersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiFounders[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiFounders|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}