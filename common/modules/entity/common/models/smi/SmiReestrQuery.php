<?php

namespace common\modules\entity\common\models\smi;

/**
 * This is the ActiveQuery class for [[SmiReestr]].
 *
 * @see SmiReestr
 */
class SmiReestrQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return SmiReestr[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return SmiReestr|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function type($type)
    {
        $this->andWhere(['type_id' => $type->id]);
        return $this;
    }

    public function type_id($type_id)
    {
        $this->andWhere(['type_id' => $type_id]);
        return $this;
    }

    public function types_id_in($types_id)
    {
        $this->andWhere(['in', 'type_id', $types_id]);
        return $this;
    }

    public function kind($kind)
    {
        $this->andWhere(['kind_id' => $kind->id]);
        return $this;
    }

    public function kind_id($kind_id)
    {
        $this->andWhere(['kind_id' => $kind_id]);
        return $this;
    }

    public function national($national)
    {
        if($national) {
            $this->andWhere(['national' => 1]);
        }else{
            $this->andWhere(['national' => 0]);
        }
        return $this;
    }

    public function begin_at($begin_at)
    {
        $this->andWhere(['begin_at' => $begin_at]);
        return $this;
    }

    public function state($state)
    {
        if($state) {
            $this->andWhere(['state' => 1]);
        }else{
            $this->andWhere(['state' => 0]);
        }
        return $this;
    }

    public function frequency_period($frequency_period = 'week')
    {
        $this->andWhere(['frequency_period' => $frequency_period]);
        return $this;
    }

    public function frequency_times($frequency_times)
    {
        $this->andWhere(['frequency_times' => $frequency_times]);
        return $this;
    }

    public function distribution_type($distributionType)
    {
        $this->andWhere(['distribution_type_id' => $distributionType->id]);
        return $this;
    }

    public function distribution_type_id($distribution_type_id)
    {
        $this->andWhere(['distribution_type_id' => $distribution_type_id]);
        return $this;
    }

    public function region($region)
    {
        $this->andWhere(['region_id' => $region->id]);
        return $this;
    }

    public function region_id($region_id)
    {
        $this->andWhere(['region_id' => $region_id]);
        return $this;
    }

    public function city($city)
    {
        $this->andWhere(['city_id' => $city->id]);
        return $this;
    }

    public function city_id($city_id)
    {
        $this->andWhere(['city_id' => $city_id]);
        return $this;
    }

    public function specialization($specialization)
    {
        $this->joinWith('smiSpecialization')
            ->andWhere(['`smi_specialization`.`id`' => $specialization->id]);
        return $this;
    }

    public function specialization_id($specialization_id)
    {
        $this->joinWith('smiSpecialization')
            ->andWhere(['`smi_specialization`.`id`' => $specialization_id]);
        return $this;
    }

    public function founder($founder)
    {
        $this->joinWith('smiFounders')
            ->andWhere(['`smi_founders`.`id`' => $founder->id]);
        return $this;
    }

    public function founder_id($founder_id)
    {
        $this->joinWith('smiFounders')
            ->andWhere(['`smi_founders`.`id`' => $founder_id]);
        return $this;
    }
}