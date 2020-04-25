<?php
namespace backend\controllers;

use common\models\AppleList;
use yii\web\Controller;

class ItemController extends Controller
{
    public function actionGenerateItems($from, $to)
    {
        //item/generate-items

        $appleList = new AppleList(Yii::$app->user->identity);
        $appleList->clear();
        $appleList->init($from, $to);

        $this->goHome();
    }

    public function actionHandleStateFunction()
    {
        $this->goHome();
        $stateId = \Yii::$app->request->post('state-id');
    }
}
