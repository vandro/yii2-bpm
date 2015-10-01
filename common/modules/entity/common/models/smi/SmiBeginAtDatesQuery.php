<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiBeginAtDates]].
 *
 * @see SmiBeginAtDates
 */
class SmiBeginAtDatesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiBeginAtDates[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiBeginAtDates|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}