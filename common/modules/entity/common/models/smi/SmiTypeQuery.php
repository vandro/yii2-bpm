<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiType]].
 *
 * @see SmiType
 */
class SmiTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}