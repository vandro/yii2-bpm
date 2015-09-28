<?php

namespace common\modules\entity\common\models\permission;

use common\modules\entity\common\models\EntityFields;
use common\modules\entity\common\models\EntityTypes;
use common\modules\entity\common\models\NodesActions;
use common\modules\entity\common\models\ProcessNodes;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "nodes_conditions".
 *
 * @property integer $id
 * @property integer $node_id
 * @property string $true_next_exec_type
 * @property string $false_next_exec_type
 * @property integer $true_action_id
 * @property integer $false_action_id
 * @property integer $true_condition_id
 * @property integer $false_condition_id
 * @property string $operator
 * @property integer $operand_1_entity_id
 * @property integer $operand_1_field_id
 * @property string $operand_2
 *
 * @property EntityFields $operand1Field
 * @property EntityTypes $operand1Entity
 * @property NodesConditions $falseCondition
 * @property NodesConditions[] $nodesConditions
 * @property NodesConditions $trueCondition
 * @property NodesConditions[] $nodesConditions0
 * @property NodesActions $falseAction
 * @property NodesActions $trueAction
 * @property ProcessNodes $node
 */
class NodesConditions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nodes_conditions';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('sdb');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['node_id'], 'required'],
            [['node_id', 'true_action_id', 'false_action_id', 'true_condition_id', 'false_condition_id', 'operand_1_entity_id', 'operand_1_field_id'], 'integer'],
            [['operator', 'operand_2', 'true_next_exec_type', 'false_next_exec_type'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'node_id' => Yii::t('app', 'Node ID'),
            'true_next_exec_type' => Yii::t('app', 'True Next Execution Type'),
            'false_next_exec_type' => Yii::t('app', 'False Next Execution Type'),
            'true_action_id' => Yii::t('app', 'True Action ID'),
            'false_action_id' => Yii::t('app', 'False Action ID'),
            'true_condition_id' => Yii::t('app', 'True Condition ID'),
            'false_condition_id' => Yii::t('app', 'False Condition ID'),
            'operator' => Yii::t('app', 'Operator'),
            'operand_1_entity_id' => Yii::t('app', 'Operand 1 Entity ID'),
            'operand_1_field_id' => Yii::t('app', 'Operand 1 Field ID'),
            'operand_2' => Yii::t('app', 'Operand 2'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperand1Field()
    {
        return $this->hasOne(EntityFields::className(), ['id' => 'operand_1_field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperand1Entity()
    {
        return $this->hasOne(EntityTypes::className(), ['id' => 'operand_1_entity_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFalseCondition()
    {
        return $this->hasOne(NodesConditions::className(), ['id' => 'false_condition_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentFalseCondition()
    {
        return $this->hasOne(NodesConditions::className(), ['false_condition_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodesConditions()
    {
        return $this->hasMany(NodesConditions::className(), ['false_condition_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrueCondition()
    {
        return $this->hasOne(NodesConditions::className(), ['id' => 'true_condition_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentTrueCondition()
    {
        return $this->hasOne(NodesConditions::className(), ['true_condition_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNodesConditions0()
    {
        return $this->hasMany(NodesConditions::className(), ['true_condition_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFalseAction()
    {
        return $this->hasOne(NodesActions::className(), ['id' => 'false_action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrueAction()
    {
        return $this->hasOne(NodesActions::className(), ['id' => 'true_action_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNode()
    {
        return $this->hasOne(ProcessNodes::className(), ['id' => 'node_id']);
    }

    /**
     * @inheritdoc
     * @return NodesConditionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NodesConditionsQuery(get_called_class());
    }

    public function getAllEntityTypes()
    {
//        $this->node->process->nodes->actions->forms->entities;
        return ArrayHelper::map(EntityTypes::find()->all(), 'id', 'title');
    }

    public function getEntityTypeFields()
    {
        return ArrayHelper::map(EntityFields::find()->where(['entity_id' => $this->operand_1_entity_id])->all(), 'id', 'title');
    }

    public function getTitle()
    {
        $operator = '';
        switch($this->operator){
            case 'equal':
                $operator = '==';
                break;
            default:
                $operator = '==';
                break;
        }
        return '<var style="color: red;">'.$this->operand1Entity->title.'.'.$this->operand1Field->title.'</var> <var style="color: blue;">'.$operator.'</var> <var style="color: green;">"'.$this->operand_2.'"</var>';
    }

    public function getTrueActionAddUrl()
    {
        $customUrl = Yii::$app->getUrlManager()->createUrl(['entity/conditions/add-true-action', 'id' => $this->id]);
        return Html::a( '<span class="glyphicon glyphicon-info-sign"></span>', $customUrl,
            ['title' => Yii::t('yii', 'Add action'), 'data-pjax' => 0]);
    }

    public function getFalseActionAddUrl()
    {
        $customUrl = Yii::$app->getUrlManager()->createUrl(['entity/conditions/add-false-action', 'id' => $this->id]);
        return Html::a( '<span class="glyphicon glyphicon-info-sign"></span>', $customUrl,
            ['title' => Yii::t('yii', 'Add action'), 'data-pjax' => 0]);
    }

    public function getTrueConditionAddUrl()
    {
        $customUrl = Yii::$app->getUrlManager()->createUrl(['entity/conditions/add-true-condition', 'node_id' => $this->node_id, 'parent_id' => $this->id]);
        return Html::a( '<span class="glyphicon glyphicon-question-sign"></span>', $customUrl,
            ['title' => Yii::t('yii', 'Add condition'), 'data-pjax' => 0]);
    }

    public function getFalseConditionAddUrl()
    {
        $customUrl = Yii::$app->getUrlManager()->createUrl(['entity/conditions/add-false-condition', 'node_id' => $this->node_id, 'parent_id' => $this->id]);
        return Html::a( '<span class="glyphicon glyphicon-question-sign"></span>', $customUrl,
            ['title' => Yii::t('yii', 'Add condition'), 'data-pjax' => 0]);
    }

    public function getDeleteUrl()
    {
        $customUrl = Yii::$app->getUrlManager()->createUrl(['entity/conditions/delete', 'id' => $this->id]);
        return Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customUrl,
            ['title' => Yii::t('yii', 'Add condition'), 'data-pjax' => 0]);
    }

    public function render()
    {
        $html = '<ul>';
        $html .= '<li style="font-size: large; list-style: none;"><var style="color: blue;">если</var> ( '.$this->title.' ) <var style="color: blue;">тогда </var>{';

        if($this->true_next_exec_type == 'condition') {
            if(!empty($this->trueCondition)) {
                $html .= $this->trueCondition->render();
                $html .= $this->getTrueActionAddUrl();
            }else{
                $html .= $this->getTrueConditionAddUrl();
                $html .= $this->getTrueActionAddUrl();
            }
        }else{
            if(!empty($this->trueAction)) {
                $html .= '<ul><li style="font-size: large; list-style: none;">';
                $html .= $this->trueAction->title;
                $html .= $this->getTrueConditionAddUrl();
                $html .= '</li></ul>';
            }else{
                $html .= $this->getTrueConditionAddUrl();
                $html .= $this->getTrueActionAddUrl();
            }
        }

        $html .= '<var>} <var style="color: blue;">иначе</var> {</var>';

        if($this->false_next_exec_type == 'condition') {
            if(!empty($this->falseCondition)) {
                $html .= $this->falseCondition->render();
                $html .= $this->getFalseActionAddUrl();
            }else{
                $html .= $this->getFalseConditionAddUrl();
                $html .= $this->getFalseActionAddUrl();
            }
        }else{
            if(!empty($this->falseAction)) {
                $html .= '<ul><li style="font-size: large; list-style: none;">';
                $html .= $this->falseAction->title;
                $html .= $this->getFalseConditionAddUrl();
                $html .= '</li></ul>';
            }else{
                $html .= $this->getFalseConditionAddUrl();
                $html .= $this->getFalseActionAddUrl();
            }
        }

        $html .= '<var>}</var>';
        $html .= $this->getDeleteUrl();
        $html .= '</li>';
        $html .= '</ul>';

        return $html;
    }
}
