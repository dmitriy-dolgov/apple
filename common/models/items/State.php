<?php

namespace common\models\items;

abstract class State
{
    /** @var  common\models\Fruit */
    protected $fruit;


    public function __construct(common\models\Fruit $fruit)
    {
        $this->fruit = $fruit;
    }

    abstract public function getFunctions();
}
