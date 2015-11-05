<?php
/**
 * Created by PhpStorm.
 * User: a_niyazov
 * Date: 15.10.2015
 * Time: 15:32
 */
namespace common\modules\entity\common\factories;

use common\helpers\DebugHelper;
use common\modules\entity\common\models\permission\Gridviews;
use common\modules\generator\gridviews\GridViewClassGenerator2;
use Yii;
use common\modules\generator\entity\EntityTypeClassGenerator;
use common\modules\entity\common\models\EntityTypes;
use yii\grid\GridView;
use yii\web\NotFoundHttpException;


class GridViewClassFactory2
{
    protected static $namespace = 'frontend\runtime\generated';

    public static function get($grid_view_id, $generate = false)
    {
        $gridView = self::getGridView($grid_view_id);
        $gridViewClass = self::getClassName($gridView);
        if(class_exists($gridViewClass) && !$generate){
            return $gridViewClass;
        }else{
            if(GridViewClassGenerator2::generateFile($grid_view_id,'frontend\runtime\generated','pdb', Yii::$app->basePath.'/runtime/generated')) {
                return $gridViewClass;
            }
        }
    }

    public static function getParams($grid_view_id)
    {
        return GridViewClassGenerator2::generateFile($grid_view_id,'frontend\runtime\generated','pdb', Yii::$app->basePath.'/runtime/generated');
    }

    protected static function getGridView($id)
    {
        if (($model = Gridviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested grid view does not exist.');
        }
    }

    protected static function getClassName($gridView)
    {
        return static::$namespace.'\\GridView'.$gridView->id;
    }
}