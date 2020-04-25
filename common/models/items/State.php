<?php

namespace common\models\items;

abstract class State
{
    /** @var  common\models\Fruit */
    protected $fruit;


    public function __construct(\common\models\Fruit $fruit, $data = false)
    {
        $this->fruit = $fruit;
    }

    abstract public function getName();

    abstract public function getFunctions();

    public function getData()
    {
        return [];
    }

    public function getId()
    {
        $parts = explode('\\', get_called_class());
        return end($parts);
    }
}
