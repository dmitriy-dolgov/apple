<?php

namespace common\models;


use common\models\db\Apple;

class AppleList
{
    protected $list = [];
    /** @var User */
    protected $listUser;


    public function __construct(User $user)
    {
        $this->listUser = $user;

        if (!$user->apples) {
            $this->randomInit();
            $this->saveToDb();
        } else {
            $this->loadFromDb();
        }
    }

    public function randomInit()
    {
        $this->list = [];

        $amount = rand(1, 5);

        for ($i = 0; $i < $amount; ++$i) {
            $apple = new AppleFruit();
            $apple->randomInit();
            $this->list[] = $apple;
        }
    }

    public function saveToDb()
    {
        $listSerialized = serialize($this->list);
        $newRecord = new Apple();
        $newRecord->apple_data = $listSerialized;
        $this->listUser->link('apples', $newRecord);
    }

    public function loadFromDb()
    {
        $this->list = [];

        $applesData = $this->listUser->apples[0];

        if ($applesSerialized = $applesData->apple_data) {
            if (is_array($appleList = unserialize($applesSerialized))) {
                $this->list = $appleList;
            } else {
                \Yii::error('Не удалось unserialize: ' . $applesSerialized);
                $this->listUser->apples[0]->delete();
            }
        }
    }
}
