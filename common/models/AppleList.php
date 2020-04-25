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
    }

    public function clear()
    {
        Apple::deleteAll(['user_id' => $this->listUser->getId()]);
        $this->list = [];
    }

    public function init($from = 1, $to = 50)
    {
        if (!$this->listUser->apples) {
            $this->randomInit($from, $to);
            $this->saveToDb();
        } else {
            $this->loadFromDb();
        }
    }

    protected function randomInit($from, $to)
    {
        $this->list = [];

        $amount = rand($from, $to);

        for ($i = 0; $i < $amount; ++$i) {
            $apple = new AppleFruit();
            $apple->randomInit();
            $this->list[] = $apple;
        }
    }

    protected function saveToDb()
    {
        foreach ($this->list as $id => $apple) {
            $appleSerialized = serialize($apple);
            if (!$dbApple = Apple::findOne($id)) {
                $dbApple = new Apple();
            }
            $dbApple->apple_data = $appleSerialized;
            $this->listUser->link('apples', $dbApple);
        }
    }

    protected function loadFromDb()
    {
        $this->list = [];

        foreach ($this->listUser->apples as $appleElement) {
            $appleObj = unserialize($appleElement->apple_data);
            if (is_object($appleObj)) {
                $this->list[$appleElement->getPrimaryKey()] = $appleObj;
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
