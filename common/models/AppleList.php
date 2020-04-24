<?php
namespace common\models;


class AppleList
{
    protected $list = [];
    /** @var User  */
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

        $amount = rand(1, 50);

        for ($i = 0; $i < $amount; ++$i) {
            $apple = new AppleFruit();
            $apple->randomInit();
            $this->list = $apple;
        }
    }

    public function saveToDb()
    {
        $listJson = json_encode($this->list);
        $newRecord = new AppleFruit();
        $newRecord->apple_data = $listJson;
        $this->listUser->apples[0] = $newRecord->apple_data;
    }

    public function loadFromDb()
    {
        $applesData = $this->listUser->apples[0];

        $applesJson = $applesData->apple_data;
        //$this->list = [];
    }
}
