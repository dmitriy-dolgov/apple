<?php

namespace common\models\items\state;

use common\models\items\common;

class OnTree extends \common\models\items\State
{
    public function getFunctions()
    {
        return [
            'fall' => [
                'name' => 'Упасть на землю',
                'params' => [
                    'type' => 'datetime',
                    'description' => 'Время падения',
                ],
                'func' => function ($datetime) {
                    return new OnGround($this->fruit, $datetime);
                },
            ],
        ];
    }

    public function getName()
    {
        return 'На дереве';
    }
}
