<?php

namespace common\models;

use common\models\db\Apple;
use common\models\items\state\OnTree;

class AppleFruit extends Fruit
{
    public $name = 'Яблоко';


    public function __construct()
    {
        $this->setState(new OnTree($this));
    }

    public static function getInstanceById($fruitId, $userId = false): ?AppleFruit
    {
        $appleObj = null;

        if ($appleDb = Apple::findOne($fruitId)) {

            if ($userId && ($appleDb->user_id != $userId)) {
                throw new ForbiddenHttpException();
            }

            $appleObj = unserialize($appleDb->apple_data);
            if (!is_object($appleObj)) {
                \Yii::error('Не удалось unserialize даные яблока: ' . $appleDb->apple_data);
                $appleDb->delete();
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

    public static function deleteById($fruitId, $userId = false)
    {
        if ($appleDb = Apple::findOne($fruitId)) {

            if ($userId && ($appleDb->user_id != $userId)) {
                throw new ForbiddenHttpException();
            }

            $appleDb->delete();
        }
    }
}
