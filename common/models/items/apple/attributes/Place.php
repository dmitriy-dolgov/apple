<?php

namespace common\models\items\apple\attributes;

use common\models\items\IAttribute;

class Place implements IAttribute
{
    protected $value;


    public function getName()
    {
        return 'Где находится';
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getSupportedOperations() {
        return ['fall', 'eat', 'spoil'];
    }

    public function initValue()
    {
        $this->value = 'on_tree';
    }

    public function needsDataToUpdateState()
    {
        return false;
    }

    public function allowUpdataState($operation)
    {
        if ($operation == 'eat' || $operation == 'spoil') {
            if ($this->value == 'on_tree') {
                return false;
            }
        }

        if ($operation == 'fall') {
            if ($this->value != 'on_tree') {
                throw new \Exception('Яблоко уже упало');
            }
        }

        return true;
    }

    public function updataState($operation, $data = [])
    {
        if ($operation == 'fall') {
            $this->value = 'on_ground';
        }
    }
}