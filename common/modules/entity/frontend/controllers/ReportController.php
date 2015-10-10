<?php

namespace common\modules\entity\frontend\controllers;

use common\helpers\DebugHelper;
use common\modules\entity\common\models\Regions;
use common\modules\entity\common\models\smi\SmiReestr;
use common\modules\entity\common\models\smi\SmiType;
use common\modules\entity\common\reports\TotalCountByRegionsAndTypesReport;
use common\modules\entity\common\reports\TotalCountByRegionsAndTypesGovReport;
use common\modules\entity\common\reports\TotalCountByTypesGovReport;
use common\modules\entity\common\reports\TotalCountByTypeAndBeginAtDateReport;
use common\modules\entity\common\reports\TotalCountByKindAndBeginAtDateReport;
use common\modules\entity\common\reports\TotalCountByTypeAndLanguagesReport;
use common\modules\entity\common\reports\TotalCountByTypeRegionAndLanguagesReport;
use yii\web\Controller;

class ReportController extends Controller
{
    public function actionIndex($id)
    {
        $report = $this->getReport($id);
        if($report) {
            return $this->render('index', ['report' => $report]);
        }else{
            throw new NotFoundHttpException('The requested report does not exist.');
        }
    }

    protected function getReport($id)
    {
        switch($id){
            case 1:
                return new TotalCountByRegionsAndTypesReport();
            case 2:
                return new TotalCountByRegionsAndTypesGovReport();
            case 3:
                return new TotalCountByTypesGovReport();
            case 4:
                return new TotalCountByTypeAndBeginAtDateReport();
            case 5;
                return new TotalCountByKindAndBeginAtDateReport();
            case 6:
                return new TotalCountByTypeAndLanguagesReport();
            case 7;
                return new TotalCountByTypeRegionAndLanguagesReport();
            default:
                return false;
        }
    }
}
