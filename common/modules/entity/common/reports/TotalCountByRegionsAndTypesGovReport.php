<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 30.09.2015
 * Time: 19:23
 */
namespace common\modules\entity\common\reports;

use common\modules\entity\common\models\Regions;
use common\modules\entity\common\models\smi\SmiReestr;
use common\modules\entity\common\models\smi\SmiType;
use yii\base\Component;

class TotalCountByRegionsAndTypesGovReport extends Component
{
    protected $regions;
    protected $types;
    protected $smis;
    protected $html = '';

    public function render()
    {
        $this->regions = Regions::find()->all();
        $this->types = SmiType::find()->all();
        $this->smis = SmiReestr::find();

        $this->rHeader();
        $this->rTableBegin();
        $this->rTableHeader();
        $this->rTableBody();
        $this->rTableFooter();
        $this->rTableEnd();


        return $this->html;
    }

    protected function rHeader()
    {
        $this->html .= '<p style="text-align: center">';
        $this->html .= 'Ўзбекистон Матбуот ва ахборот агентлиги томонидан рўйхатга олиниб<br>';
        $this->html .= 'Давлатга қарашли бўлган ва қарашли бўлмаган ЭОАВ (ТВ, Радио) тўғрисида<br>';
        $this->html .= 'М А Ъ Л У М О Т Н О М А<br>';
        $this->html .= '('.date('Y').'  йил '.date('d').' '.$this->getMonth((int) date('m')).' ҳолатига кўра)';
        $this->html .= '</p>';
    }

    protected function rTableBegin()
    {
        $this->html .= '<table class="table table-bordered">';
    }

    protected function rTableEnd()
    {
        $this->html .= '</table>';
    }

    protected function rTableHeader()
    {
        $this->html .= '<tr>';
        $this->html .= '<td rowspan="2">№</td>';
        $this->html .= '<td rowspan="2">Ҳудуд номи</td>';
        foreach($this->types as $type){
            $this->html .= '<td colspan="3">'.$type->title.'</td>';
        }
        $this->html .= '<td colspan="3">Жами</td>';
        $this->html .= '</tr>';

        $this->html .= '<tr>';
        foreach($this->types as $type){
            $this->html .= '<td >умумий сони</td>';
            $this->html .= '<td >давлат</td>';
            $this->html .= '<td >нодавлат</td>';
        }
        $this->html .= '<td >умумий сони</td>';
        $this->html .= '<td >давлат</td>';
        $this->html .= '<td >нодавлат</td>';
        $this->html .= '</tr>';
    }

    protected function rTableBody()
    {
        $row = 1;
        foreach($this->regions as $region) {
            $this->html .= '<tr>';
            $this->html .= '<td>'.$row.'</td>';
            $this->html .= '<td>'.$region->title.'</td>';
            foreach ($this->types as $type) {
                $this->html .= '<td>' . count($region->getSmi()->type($type)->all()) . '</td>';
                $this->html .= '<td>' . count($region->getSmi()->type($type)->national(true)->all()) . '</td>';
                $this->html .= '<td>' . count($region->getSmi()->type($type)->national(false)->all()) . '</td>';
            }
            $this->html .= '<td>' . count($region->getSmi()->all()) . '</td>';
            $this->html .= '<td>' . count($region->getSmi()->national(true)->all()) . '</td>';
            $this->html .= '<td>' . count($region->getSmi()->national(false)->all()) . '</td>';
            $this->html .= '</tr>';
            $row++;
        }
    }

    protected function rTableFooter()
    {
        $this->html .= '<tr>';
        $this->html .= '<td></td>';
        $this->html .= '<td>Жами</td>';
        foreach($this->types as $type){
            $this->html .= '<td>'.count(SmiReestr::find()->type_id($type->id)->all()).'</td>';
            $this->html .= '<td>'.count(SmiReestr::find()->type_id($type->id)->national(true)->all()).'</td>';
            $this->html .= '<td>'.count(SmiReestr::find()->type_id($type->id)->national(false)->all()).'</td>';
        }
        $this->html .= '<td>'.count(SmiReestr::find()->all()).'</td>';
        $this->html .= '<td>'.count(SmiReestr::find()->national(true)->all()).'</td>';
        $this->html .= '<td>'.count(SmiReestr::find()->national(false)->all()).'</td>';
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