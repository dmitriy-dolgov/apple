<?php

namespace common\models\items\state;

use common\models\items\common;

class OnGround extends \common\models\items\State
{
    protected $size = 100;

    /** @var integer когда упал */
    protected $fellTime;

    /** @var integer текущее время */
    protected $currentTime;

    /** @var float|int как быстро сгниет */
    const ROT_TIMEOUT = 60 * 60 * 5;


    public function __construct(common\models\Fruit $fruit, $fellTime)
    {
        parent::__construct($fruit, $fellTime);

        $this->fellTime = $fellTime;
        $this->currentTime = $this->fellTime;
    }

    public function getFunctions()
    {
        return [
            'eat' => [
                'name' => 'Откусить',
                'params' => 'percent',
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
                'params' => 'time',
                'func' => function ($time) {
                    $this->currentTime += $time;
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
            ],
            [
                'description' => 'Когда упал',
                'value' => $this->fellTime,
            ]
        ];
    }
}
