<?php

namespace common\modules\epigu\models;

/**
 * This is the ActiveQuery class for [[EpiguAndEntityFieldsLink]].
 *
 * @see EpiguAndEntityFieldsLink
 */
class EpiguAndEntityFieldsLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return EpiguAndEntityFieldsLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EpiguAndEntityFieldsLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}