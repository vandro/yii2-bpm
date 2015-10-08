<?php

namespace common\modules\entity\common\models;

/**
 * This is the ActiveQuery class for [[EntityChildForm]].
 *
 * @see EntityChildForm
 */
class EntityChildFormQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return EntityChildForm[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return EntityChildForm|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}