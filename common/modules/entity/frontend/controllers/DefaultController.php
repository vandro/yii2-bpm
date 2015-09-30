<?php

namespace common\modules\entity\frontend\controllers;

use common\helpers\DebugHelper;
use common\modules\entity\common\models\Regions;
use common\modules\entity\common\models\smi\SmiReestr;
use common\modules\entity\common\models\smi\SmiType;
use common\modules\entity\common\reports\TotalCountByRegionsAndTypesReport;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        $report = new TotalCountByRegionsAndTypesReport();
        return $this->render('index', ['report' => $report]);
    }

    public function actionDashboard()
    {
        //foreach(Regions::find()->all() as $region){
            foreach(SmiType::find()->all() as $type) {
//                DebugHelper::printSingleObject($region->title .'->'.$type->title. '=' . count($region->getSmi()->type($type)->all()));
                DebugHelper::printSingleObject($type->title. '=' . count(SmiReestr::find()->type($type)->all()));
            }
        //}
//        DebugHelper::printActiveRecordsArray(Regions::find()->all());
    }
}
