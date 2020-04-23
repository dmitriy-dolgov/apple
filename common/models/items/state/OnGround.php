<?php

namespace common\models\items\state;

class OnGround implements common\models\items\IState
{
    protected $size = 100;

    /** @var integer время созревания (появления) */
    protected $ripen;

    const ROT_TIMEOUT = 60 * 60 * 5;


    public function getFunctions()
    {
        return [
            'eat' => [
                'name' => 'Съесть',
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
                    $this->ripen += $time;
                    $this->size = ($newSize < 0) ? 0 : $newSize;
                    if ($this->size == 0) {
                        throw new SignalRemove();
                    }
                },
            ],
        ];
    }
}