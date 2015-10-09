<?php

namespace common\modules\epigu\models;

/**
 * This is the ActiveQuery class for [[InActionEntityLink]].
 *
 * @see InActionEntityLink
 */
class InActionEntityLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return InActionEntityLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return InActionEntityLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}