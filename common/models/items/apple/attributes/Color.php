<?php

namespace common\models\items\apple\attributes;

use common\models\items\IAttribute;

class Color implements IAttribute
{
    protected $value;


    public function getName()
    {
        return 'Цвет';
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getSupportedOperations()
    {
        return [];
    }

    public function initValue()
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

        $this->value = $colors[rand(0, count($colors) - 1)];
    }

    public function needsDataToUpdateState()
    {
        return false;
    }

    public function allowUpdataState($operation)
    {
        return true;
    }

    public function updataState($operation, $data = [])
    {
    }
}