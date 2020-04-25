<?php

namespace common\models;


use common\models\db\Apple;

class AppleList
{
    /** @var AppleFruit[] */
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

    protected function randomInit()
    {
        $this->list = [];

        $amount = rand(1, 5);

        for ($i = 0; $i < $amount; ++$i) {
            $apple = new AppleFruit();
            $apple->randomInit();
            $this->list[] = $apple;
        }
    }

    protected function saveToDb()
    {
        $listUser = $this->listUser;
        $list = $this->list;

        Apple::getDb()->transaction(function($db) use ($list, $listUser) {
            Apple::deleteAll(['user_id' => $listUser->getId()]);
            foreach ($list as $apple) {
                $appleSerialized = serialize($apple);
                $newRecord = new Apple();
                $newRecord->apple_data = $appleSerialized;
                $listUser->link('apples', $newRecord);
            }
        });
    }

    protected function loadFromDb()
    {
        $this->list = [];

        foreach ($this->listUser->apples as $appleElement) {
            $appleObj = unserialize($appleElement->apple_data);
            if (is_object($appleObj)) {
                $this->list[] = $appleObj;
            } else {
                \Yii::error('Не удалось unserialize даные яблока: ' . $appleElement->apple_data);
                $appleElement->delete();
            }
        }
    }

    public function getList()
    {
        return $this->list;
    }
}
