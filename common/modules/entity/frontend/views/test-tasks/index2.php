<?php
use common\modules\entity\common\models\smi\SmiReestr;
use common\helpers\DebugHelper;
use common\modules\entity\common\models\Languages;
?>
<div class="frontend-default-index">
    <?php
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
    $arLanguageCountValues = [];
    foreach($arCountValues as $key => $value){
        $arLanguageCountValues[$key] = [
            'key' => $key,
            'value' => $value,
            'languages' => Languages::find()->in($key)->all(),
        ];
    }
    DebugHelper::printSingleObject($arLanguageCountValues);
    ?>
</div>
