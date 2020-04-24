<?php

namespace common\models\items\state;

use common\models\items\common;

class Rotten extends \common\models\items\State
{
    /** @var integer когда сгнило */
    protected $rotTime;


    public function __construct(\common\models\Fruit $fruit, $rotTime)
    {
        parent::__construct($fruit, $rotTime);

        $this->rotTime = $rotTime;
    }

    public function getName()
    {
        return 'Гнилое';
    }

    public function getFunctions()
    {
        return [];
    }

    public function getData()
    {
        return [
            [
                'description' => 'Когда сгнило',
                'value' => $this->rotTime,
            ],
        ];
    }
}
