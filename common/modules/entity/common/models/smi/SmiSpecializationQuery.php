<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiSpecialization]].
 *
 * @see SmiSpecialization
 */
class SmiSpecializationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiSpecialization[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiSpecialization|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}