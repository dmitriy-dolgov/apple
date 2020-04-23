<?php

namespace common\models\items\state;

use common\models\items\common;

class OnTree extends common\models\items\State
{
    /** @var integer когда упал */
    protected $fell;


    public function __construct(common\models\Fruit $fruit)
    {
        parent::__construct($fruit);
    }

    public function getFunctions()
    {
        return [
            'fall' => [
                'name' => 'Упасть на землю',
                'params' => false,
                'func' => function () {
                    return new OnGround();
                },
            ],
        ];
    }
}