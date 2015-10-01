<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 30.09.2015
 * Time: 19:23
 */
namespace common\modules\entity\common\reports;

use common\helpers\DebugHelper;
use common\modules\entity\common\models\Regions;
use common\modules\entity\common\models\smi\SmiBeginAtDates;
use common\modules\entity\common\models\smi\SmiReestr;
use common\modules\entity\common\models\smi\SmiType;
use yii\base\Component;

class TotalCountByTypeAndBeginAtDateReport extends Component
{
    protected $types;
    protected $years;
    protected $html = '';

    public function render()
    {
        $this->types = SmiType::find()->all();
        $this->years = SmiBeginAtDates::find()->all();

        $this->rHeader();
        $this->rTableBegin();
        $this->rTableHeader();
        $this->rTableBody();
        $this->rTableFooter();
        $this->rTableEnd();
        $this->rFooter();


        return $this->html;
    }

    protected function rHeader()
    {
        $this->html .= '<div class="panel panel-success"">';
        $this->html .= '<div class="panel-heading">';
        $this->html .= '<p style="text-align: center">';
        $this->html .= 'Ўзбекистон Матбуот ва ахборот агентлиги томонидан рўйхатга олиниб<br>';
        $this->html .= 'Йиллар бўйича ОАВ тури сифатида рўйхатга олинган ҳақида <br>';
        $this->html .= 'М А Ъ Л У М О Т Н О М А<br>';
        $this->html .= '('.date('Y').'  йил '.date('d').' '.$this->getMonth((int) date('m')).' ҳолатига кўра)';
        $this->html .= '</p>';
        $this->html .= '</div>';
    }

    protected function rFooter()
    {
        $this->html .= '</div>';
    }

    protected function rTableBegin()
    {
        $this->html .= '<div class="panel-body" style="overflow: auto;"><table class="table table-bordered">';
    }

    protected function rTableEnd()
    {
        $this->html .= '</table></div>';
    }

    protected function rTableHeader()
    {
        $this->html .= '<tr>';
        $this->html .= '<td>№</td>';
        $this->html .= '<td>ОАВ тури</td>';
        foreach($this->years as $year){
            $this->html .= '<td>'.$year->begin_at.'</td>';
        }
        $this->html .= '</tr>';
    }

    protected function rTableBody()
    {
        $row = 1;
        foreach($this->types as $type) {
            $this->html .= '<tr>';
            $this->html .= '<td>'.$row.'</td>';
            $this->html .= '<td>'.$type->title.'</td>';
            foreach ($this->years as $year) {
                $this->html .= '<td>' . count(SmiReestr::find()->type($type)->begin_at($year->begin_at)->all()) . '</td>';
            }
            $this->html .= '</tr>';
            $row++;
        }
    }

    protected function rTableFooter()
    {
        $this->html .= '<tr class="success">';
        $this->html .= '<td></td>';
        $this->html .= '<td>Жами</td>';
        foreach($this->years as $year){
            $this->html .= '<td>'.count(SmiReestr::find()->begin_at($year->begin_at)->all()).'</td>';
        }
        $this->html .= '</tr>';
    }

    protected function getMonth($num)
    {
        $month = [
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        ];

        return $month[$num];
    }

    protected function deviseByZero($operand1, $operand2)
    {
        if(empty($operand1) or empty($operand2)){
            return 0;
        }else{
            return $operand1/$operand2;
        }
    }
}