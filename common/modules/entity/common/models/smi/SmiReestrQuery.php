<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiReestr]].
 *
 * @see SmiReestr
 */
class SmiReestrQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiReestr[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiReestr|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}