<?php

namespace common\models;

use common\models\items\state\OnTree;

class Fruit
{
    public $name = 'Неизвестный фрукт';

    /** @var common\models\items\State[] список прежних состояний */
    protected $stateList = [];

    /** @var common\models\items\State состояние фрукта */
    protected $currentState;

    /** @var string */
    protected $color;

    /** @var integer когда созрел (появился) */
    protected $ripen;


    public function __construct()
    {
        $this->currentState = new OnTree($this);
    }

    public function randomInit()
    {
        $colors = [
            'lightsalmon',
            'salmon',
            'darksalmon',
            'lightcoral',
            'indianred',
            'crimson	',
            'firebrick',
            'red',
            'darkred',
            'lawngreen	',
            'chartreuse',
            'limegreen	',
            'lime',
            'forestgreen',
            'green',
            'darkgreen',
            'greenyellow',
            'yellowgreen',
            'springgreen',
            'mediumspringgreen',
            'lightgreen',
            'palegreen	',
            'darkseagreen	',
            'mediumseagreen	',
            'seagreen',
            'olive',
            'darkolivegreen	',
            'olivedrab',
        ];

        $this->color = $colors[rand(0, count($colors) - 1)];

        $this->ripen = time() - rand(0, 8640000);
    }
}
