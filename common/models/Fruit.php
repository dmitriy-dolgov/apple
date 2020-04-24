<?php

namespace common\models;

use common\models\items\State;
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

    /*public function getCurrentFunctions()
    {
        return $this->currentState->getFunctions();
    }*/

    public function getCurrentState(): State
    {
        return $this->currentState;
    }

    public function runFunction($functionName, $params = false)
    {
        $function = $this->currentState->getFunctions()[$functionName];

        assert(is_array($function));

        if ($fResult = $function['func']($params)) {
            if (is_a($fResult, 'State')) {
                $this->stateList[] = $fResult;
                $this->currentState = $fResult;
            }
        }
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
