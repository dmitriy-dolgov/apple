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
                    'type' => 'time',
                    'description' => 'Время падения с момента создания, мин.',
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
