<?php

namespace common\modules\entity\common\models\permission;

/**
 * This is the ActiveQuery class for [[ProcessOrganDepartLink]].
 *
 * @see ProcessOrganDepartLink
 */
class ProcessOrganDepartLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ProcessOrganDepartLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProcessOrganDepartLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}