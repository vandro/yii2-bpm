<?php

namespace common\modules\entity\common\models\permission;

/**
 * This is the ActiveQuery class for [[Rights]].
 *
 * @see Rights
 */
class RightsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/


    /**
     * @inheritdoc
     * @return Rights[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Rights|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}