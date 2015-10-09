<?php

namespace common\modules\epigu\models;

/**
 * This is the ActiveQuery class for [[EpiguServiceFileds]].
 *
 * @see EpiguServiceFileds
 */
class EpiguServiceFiledsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return EpiguServiceFileds[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EpiguServiceFileds|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}