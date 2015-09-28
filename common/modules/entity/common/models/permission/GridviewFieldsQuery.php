<?php

namespace common\modules\entity\common\models\permission;

/**
 * This is the ActiveQuery class for [[GridviewFields]].
 *
 * @see GridviewFields
 */
class GridviewFieldsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return GridviewFields[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return GridviewFields|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}