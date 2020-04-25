<?php

namespace common\models;

use Yii;
use common\models\db\Apple;

class AppleFruit extends Fruit
{
    public $name = 'Яблоко';


    public function __construct()
    {
        $this->currentState = new OnTree($this);
    }

    public static function instanceById($fruitId, $userId = false): ?AppleFruit
    {
        $appleObj = null;

        if ($appleElement = Apple::findOne($fruitId)) {

            if ($appleElement->user_id != Yii::$app->user->identity->getId()) {
                throw new ForbiddenHttpException();
            }

            $appleObj = unserialize($appleElement->apple_data);
            if (!is_object($appleObj)) {
                \Yii::error('Не удалось unserialize даные яблока: ' . $appleElement->apple_data);
                $appleElement->delete();
                $appleObj = null;
            }
        }

        return $appleObj;
    }
}
