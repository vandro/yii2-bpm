<?php

namespace common\modules\entity\common\models\permission;

use Yii;
/**
 * This is the ActiveQuery class for [[Tasks]].
 *
 * @see Tasks
 */
class TasksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    public function in($nodes)
    {
        $arNodesIds = [];
        foreach($nodes as $node){
            $arNodesIds[] = $node->node_id;
        }
        $this->andWhere(['in', 'current_node_id', $arNodesIds]);

        return $this;
    }

    public function rights()
    {
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();

        if(!empty($user)) {
            if($user->hasRight('organization')){
                $this->andWhere('organisation_id = '.$user->organisation_id);
            }elseif($user->hasRight('department')){
                $this->andWhere('department_id = '.$user->department_id);
            }elseif($user->hasRight('owner')){
                $this->andWhere('author_id = '.$user->id);
            }elseif($user->hasRight('assigned')){
                $this->andWhere('assigned_to_id = '.$user->id);
            }elseif($user->hasRight('organizations') && $user->hasRight('departments')){
                if(!empty($user->organizationsIds)) {
                    $this->andWhere(['in', 'organisation_id', $user->organizationsIds]);
                }
                if(!empty($user->departmentsIds)) {
                    $this->andWhere(['in', 'department_id', $user->departmentsIds]);
                }
            }elseif($user->hasRight('organizations')){
                if(!empty($user->organizationsIds)) {
                    $this->andWhere(['in', 'organisation_id', $user->organizationsIds]);
                }
            }elseif($user->hasRight('departments')){
                if(!empty($user->departmentsIds)) {
                    $this->andWhere(['in', 'department_id', $user->departmentsIds]);
                }else{
                    $this->andWhere('organisation_id = '.$user->organisation_id);
                }
            }

        }else{
            throw new HttpException(404,'You should login before get tasks.');
        }

        return $this;

    }

    public function rights2()
    {
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();

        if(!empty($user)) {

            if($user->hasRight('organization')){
                $this->andWhere('organisation_id = '.$user->organisation_id);
            }

            if($user->hasRight('department')){
                $this->andWhere('department_id = '.$user->department_id);
            }

            if($user->hasRight('owner')){
                $this->andWhere('author_id = '.$user->id);
            }

            if($user->hasRight('assigned')){
                $this->andWhere('assigned_to_id = '.$user->id);
            }

            if($user->hasRight('organizations')){
                if(!empty($user->organizationsIds)) {
                    $this->andWhere('organisation_id in ' . $user->organizationsIds);
                }
            }

            if($user->hasRight('departments')){
                if(!empty($user->departmentsIds)) {
                    $this->andWhere('department_id in ' . $user->departmentsIds);
                }else{
                    $this->andWhere('organisation_id = '.$user->organisation_id);
                }
            }

        }else{
            throw new HttpException(404,'You should login before get tasks.');
        }

        return $this;

    }


    /**
     * @inheritdoc
     * @return Tasks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tasks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}