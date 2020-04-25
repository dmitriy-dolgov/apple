<?php

namespace common\models;

use common\models\items\SignalFunction;
use common\models\items\State;

abstract class Fruit
{
    public $name = 'Неизвестный фрукт';

    /** @var common\models\items\State[] список прежних состояний */
    protected $stateList = [];

    /** @var common\models\items\State состояние фрукта */
    protected $currentState;

    /** @var string цвет в CSS стиле */
    public $color;

    /** @var integer unix timestamp когда созрел (появился) */
    public $ripen;

    /** @var integer unix timestamp текущее время */
    public $currentTime;

    /** @var int сколько не съедено */
    public $size = 100;


    abstract public static function getInstanceById($fruitId, $userId = false);

    abstract public function saveById($fruitId, User $user);

    abstract public static function deleteById($fruitId, $userId = false);

    public function getCurrentState(): State
    {
        return $this->currentState;
    }

    public function runFunction($functionName, $params = false)
    {
        $functionList = $this->currentState->getFunctions();

        if (!isset($functionList[$functionName])) {
            throw new SignalFunction('Функция отсутствует', 1);
        }

        $function = $this->currentState->getFunctions()[$functionName];

        assert(is_array($function));

        if ($fResult = $function['func']($params)) {
            if (is_a($fResult, '\common\models\items\State')) {
                $this->setState($fResult);
            }
        }
    }

    protected function setState(\common\models\items\State $state)
    {
        $this->stateList[] = $state;
        $this->currentState = $state;
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
