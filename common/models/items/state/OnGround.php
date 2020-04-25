<?php

namespace common\models\items\state;

use common\models\items\common;
use common\models\items\SignalRemove;

class OnGround extends \common\models\items\State
{
    protected $size = 100;

    /** @var integer когда упало */
    protected $fellTime;

    /** @var integer текущее время */
    protected $currentTime;

    /** @var float|int как быстро сгниет */
    const ROT_TIMEOUT = 60 * 60 * 5;


    public function __construct(\common\models\Fruit $fruit, $fellTime)
    {
        parent::__construct($fruit, $fellTime);

        $this->fellTime = $fellTime;
        $this->currentTime = $this->fellTime;
    }

    public function getName()
    {
        return 'На земле';
    }

    public function getFunctions()
    {
        return [
            'eat' => [
                'name' => 'Откусить',
                'params' => [
                    'type' => 'percent',
                    'description' => 'Сколько откусить в %',
                ],
                'func' => function ($eaten) {
                    $newSize = $this->size - $eaten;
                    $this->size = ($newSize < 0) ? 0 : $newSize;
                    if ($this->size == 0) {
                        throw new SignalRemove();
                    }
                },
            ],
            'time-passed' => [
                'name' => 'Увеличить время',
                'params' => [
                    'type' => 'time',
                    'description' => 'Сколько времени прошло в минутах',
                ],
                'func' => function ($time) {
                    $this->currentTime += $time * 60;
                    $rotAfter = $this->fellTime + self::ROT_TIMEOUT;
                    if ($this->currentTime >= $rotAfter) {
                        return new Rotten($this->fruit, $rotAfter);
                    }
                },
            ],
        ];
    }

    public function getData()
    {
        return [
            [
                'description' => 'Сколько процентов осталось',
                'value' => $this->size,
                'type' => 'percent',
            ],
            [
                'description' => 'Когда упало',
                'value' => $this->fellTime,
                'type' => 'timestamp',
            ],
            [
                'description' => 'Текущее время',
                'value' => $this->currentTime,
                'type' => 'timestamp',
            ],
        ];
    }
}
