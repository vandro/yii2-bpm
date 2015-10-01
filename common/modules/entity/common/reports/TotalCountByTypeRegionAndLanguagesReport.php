<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 30.09.2015
 * Time: 19:23
 */
namespace common\modules\entity\common\reports;

use common\helpers\DebugHelper;
use common\modules\entity\common\models\Languages;
use common\modules\entity\common\models\Regions;
use common\modules\entity\common\models\smi\SmiBeginAtDates;
use common\modules\entity\common\models\smi\SmiKind;
use common\modules\entity\common\models\smi\SmiReestr;
use common\modules\entity\common\models\smi\SmiType;
use yii\base\Component;

class TotalCountByTypeRegionAndLanguagesReport extends Component
{
    protected $languages;
    protected $languageCombinations;
    protected $type_id;
    protected $types;
    protected $regions;
    protected $html = '';

    public function render()
    {
        $this->types = SmiType::find()->all();
        $this->regions = Regions::find()->all();
        $this->languages = Languages::find()->all();
        $this->languageCombinations = $this->getLanguagesCombinationsKeys();
        $type_id = \Yii::$app->request->get('type_id');
        $this->type_id = !empty($type_id)?$type_id:$this->types[0]->id;

        $this->rHeader();
        $this->rFilter();
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
        $this->html .= '<div class="panel panel-success">';
        $this->html .= '<div class="panel-heading">';
        $this->html .= '<p style="text-align: center">';
        $this->html .= 'Ўзбекистон Матбуот ва ахборот агентлиги томонидан рўйхатга олиниб<br>';
        $this->html .= 'ЎзМАА томонидан рўйхатга олинган ОАВ тиллари бўйича  <br>';
        $this->html .= 'М А Ъ Л У М О Т Н О М А<br>';
        $this->html .= '('.date('Y').'  йил '.date('d').' '.$this->getMonth((int) date('m')).' ҳолатига кўра)';
        $this->html .= '</p>';
        $this->html .= '</div>';
    }

    protected function rFooter()
    {
        $this->html .= '</div>';
    }

    protected function rFilter()
    {
        $this->html .= '<div class="panel-body">';
        $this->html .= '<form action="index" method="get" class="form-inline">';
        $this->html .= '<input type="hidden" value="7" name="id">';
        $this->html .= '<div class="form-group">';
        $this->html .= '<label for="exampleInputEmail1">ОАВ тури</label> ';
        $this->html .= '<select class="form-control" name="type_id">';
        foreach($this->types as $type) {
            $selected = ($type->id == $this->type_id)?'selected':'';
            $this->html .= '<option value="'.$type->id.'" '.$selected.'>'.$type->title.'</option>';
        }
        $this->html .= '</select>';

        $this->html .= ' <button type="submit" class="btn btn-success">Submit</button>';
        $this->html .= '</form>';
        $this->html .= '</div>';
        $this->html .= '</div>';

    }

    protected function rTableBegin()
    {
        $this->html .= '<div class="panel panel-success" style="overflow: auto; margin-bottom: 0px;">';
        $this->html .= '<table class="table table-bordered">';
    }

    protected function rTableEnd()
    {
        $this->html .= '</table></div>';
    }

    protected function rTableHeader()
    {
        $this->html .= '<tr>';
        $this->html .= '<td>№</td>';
        $this->html .= '<td>Ҳудуд номи</td>';
        $langCombinationsCount = $this->getLanguagesCombinationsCounts(SmiReestr::find()->all());
        foreach($this->languageCombinations as $combinations){
            $this->html .= '<td>';
            $str = $combinations;
            foreach($langCombinationsCount[$combinations]['languages'] as $language){
                $str = str_replace($language->id, $language->title, $str);
            }
            $this->html .= $str;
            $this->html .= '</td>';
        }
        $this->html .= '</tr>';
    }

    protected function rTableBody()
    {
        $row = 1;
        foreach($this->regions as $region) {
            $this->html .= '<tr>';
            $this->html .= '<td>'.$row.'</td>';
            $this->html .= '<td>'.$region->title.'</td>';
            $langCombinationsCount = $this->getLanguagesCombinationsCounts(SmiReestr::find()->region($region)->type_id($this->type_id)->all());
            foreach ($this->languageCombinations as $combinations) {
                if(isset($langCombinationsCount[$combinations]['value'])) {
                    $this->html .= '<td>' . $langCombinationsCount[$combinations]['value'] . '</td>';
                }else{
                    $this->html .= '<td>0</td>';
                }
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
        $langCombinationsCount = $this->getLanguagesCombinationsCounts(SmiReestr::find()->type_id($this->type_id)->all());
        foreach ($this->languageCombinations as $combinations) {
            if(isset($langCombinationsCount[$combinations]['value'])) {
                $this->html .= '<td>' . $langCombinationsCount[$combinations]['value'] . '</td>';
            }else{
                $this->html .= '<td>0</td>';
            }
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

    protected function  getLanguagesCombinationsKeys()
    {
        $arLandCombinations = [];
        foreach(SmiReestr::find()->all() as $smi) {
            $strLand = '';
            $languages = $smi->languages;
            $count = count($languages);
            $index = 0;
            foreach($languages as $language){
                $index++;
                if($count <= $index) {
                    $strLand .= $language->id;
                }else{
                    $strLand .= $language->id . ',';
                }
            }

            $arLandCombinations[] = $strLand;
        }

        $arCountValues = array_count_values($arLandCombinations);
        $arLanguageKeys = [];
        foreach($arCountValues as $key => $value){
            $arLanguageKeys[] = $key;
        }
        return $arLanguageKeys;
    }

    protected function  getLanguagesCombinationsCounts($arSmiReestr)
    {
        $arLandCombinations = [];
        foreach($arSmiReestr as $smi) {
            $strLand = '';
            $languages = $smi->languages;
            $count = count($languages);
            $index = 0;
            foreach($languages as $language){
                $index++;
                if($count <= $index) {
                    $strLand .= $language->id;
                }else{
                    $strLand .= $language->id . ',';
                }
            }

            $arLandCombinations[] = $strLand;
        }

        $arCountValues = array_count_values($arLandCombinations);
        $arLanguageCountValues = [];
        foreach($arCountValues as $key => $value){
            $arLanguageCountValues[$key] = [
                'key' => $key,
                'value' => $value,
                'languages' => Languages::find()->in($key)->all(),
            ];
        }
        return $arLanguageCountValues;
    }
}