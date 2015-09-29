<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiLanguageLink]].
 *
 * @see SmiLanguageLink
 */
class SmiLanguageLinkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiLanguageLink[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiLanguageLink|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}