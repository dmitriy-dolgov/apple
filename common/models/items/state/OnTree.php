<?php

namespace common\models\items\state;

class OnTree implements common\models\items\IState
{
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