<?php

namespace common\modules\epigu\models;

/**
 * This is the ActiveQuery class for [[ActionHandlerLink]].
 *
 * @see ActionHandlerLink
 */
class ActionHandlerLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ActionHandlerLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ActionHandlerLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}