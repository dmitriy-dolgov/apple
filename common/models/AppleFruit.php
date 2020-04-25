<?php

namespace common\models;

use common\models\db\Apple;

class AppleFruit extends Fruit
{
    public $name = 'Яблоко';


    public function __construct()
    {
        $this->currentState = new OnTree($this);
    }

    public static function getInstanceById($fruitId, $userId = false): ?AppleFruit
    {
        $appleObj = null;

        if ($appleElement = Apple::findOne($fruitId)) {

            if ($userId && ($appleElement->user_id != $userId)) {
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

    public function saveById($fruitId, User $user)
    {
        $appleDb = Apple::findOne($fruitId);

        if (!$appleDb) {
            throw new \Exception('Не найдено яблоко с ID ' . $fruitId);
        }

        $appleDb->apple_data = serialize($this);
        $user->link('apples', $appleDb);
    }
}
