<?php

namespace backend\controllers;

use common\models\AppleFruit;
use common\models\AppleList;
use Yii;
use yii\web\Controller;

class ItemController extends Controller
{
    public function actionGenerateItems()
    {
        //item/generate-items

        $from = Yii::$app->request->post('amount')['from'];
        $to = Yii::$app->request->post('amount')['to'];

        $appleList = new AppleList(Yii::$app->user->identity);
        $appleList->clear();
        $appleList->init($from, $to);

        $this->goHome();
    }

    public function actionHandleStateFunction()
    {
        $appleId = Yii::$app->request->post('apple-id');
        $functionName = Yii::$app->request->post('state-function');
        $functionParam = false;
        if ($functionName) {
            $functionParam = Yii::$app->request->post('sfn-' . $functionName);
        }

        if ($appleObj = AppleFruit::getInstanceById($appleId, Yii::$app->user->identity->getId())) {
            $appleObj->runFunction($functionName, $functionParam);
            $appleObj->saveById($appleId, Yii::$app->user->identity);
        }

        $this->goHome();
    }
}
