<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 30.09.2015
 * Time: 19:23
 */
namespace common\modules\entity\common\reports;

use common\modules\entity\common\models\Regions;
use common\modules\entity\common\models\smi\SmiFounders;
use common\modules\entity\common\models\smi\SmiReestr;
use common\modules\entity\common\models\smi\SmiSpecialization;
use common\modules\entity\common\models\smi\SmiType;
use yii\base\Component;

class TotalCountByFoundersAndSpecializationReport extends Component
{
    protected $specialization;
    protected $founders;
    protected $html = '';

    public function render()
    {
        $this->specialization = SmiSpecialization::find()->all();
        $this->founders = SmiFounders::find()->all();

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
        $this->html .= 'Умумий ҳисобдаги давлатга қарашли бўлган ва қарашли бўлмаган ОАВ ҳақида<br>';
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
        $this->html .= '<div class="panel panel-success" style="overflow: auto;margin-bottom: 0px;">';
        $this->html .= '<table class="table table-bordered">';
    }

    protected function rTableEnd()
    {
        $this->html .= '</table></div>';
    }

    protected function rTableHeader()
    {
        $this->html .= '<tr>';
        $this->html .= '<td rowspan="2">№</td>';
        $this->html .= '<td rowspan="2">ОАВ тури</td>';
        $this->html .= '<td colspan="2">Давлатга қарашли бўлган ОАВ</td>';
        $this->html .= '<td colspan="2">Давлатга қарашли бўлмаган ОАВ</td>';
        $this->html .= '<td rowspan="2">Жами (миқдорда)</td>';
        $this->html .= '</tr>';

        $this->html .= '<tr>';
        $this->html .= '<td>миқдорда</td>';
        $this->html .= '<td>фоизда (%)</td>';
        $this->html .= '<td>миқдорда</td>';
        $this->html .= '<td>фоизда (%)</td>';
        $this->html .= '</tr>';
    }

    protected function rTableBody()
    {
        $row = 1;
        foreach($this->types as $type) {
            $this->html .= '<tr>';
            $this->html .= '<td>'.$row.'</td>';
            $this->html .= '<td>'.$type->title.'</td>';

            $total = count(SmiReestr::find()->type($type)->all());
            $national = count(SmiReestr::find()->type($type)->national(true)->all());
            $no_national = count(SmiReestr::find()->type($type)->national(false)->all());

            $this->html .= '<td>'.$national.'</td>';
            $this->html .= '<td>'.round(($this->deviseByZero($national,$total)*100),2).'%</td>';
            $this->html .= '<td>'.$no_national.'</td>';
            $this->html .= '<td>'.round(($this->deviseByZero($no_national,$total)*100),2).'%</td>';
            $this->html .= '<td>'.$total.'</td>';

            $this->html .= '</tr>';
            $row++;
        }
    }

    protected function rTableFooter()
    {
        $this->html .= '<tr class="success">';
        $this->html .= '<td></td>';
        $this->html .= '<td><b>Жами</b></td>';

        $total = count(SmiReestr::find()->all());
        $national = count(SmiReestr::find()->national(true)->all());
        $no_national = count(SmiReestr::find()->national(false)->all());

        $this->html .= '<td><b>'.$national.'</b></td>';
        $this->html .= '<td><b>'.round(($this->deviseByZero($national,$total)*100),2).'%</b></td>';
        $this->html .= '<td><b>'.$no_national.'</b></td>';
        $this->html .= '<td><b>'.round(($this->deviseByZero($no_national,$total)*100),2).'%</b></td>';
        $this->html .= '<td><b>'.$total.'</b></td>';
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