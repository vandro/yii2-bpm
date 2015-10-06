<?php

namespace common\modules\epigu\models;

/**
 * This is the ActiveQuery class for [[EpiguService]].
 *
 * @see EpiguService
 */
class EpiguServiceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return EpiguService[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EpiguService|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}