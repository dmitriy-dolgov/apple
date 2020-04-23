<?php

namespace common\models\items\apple\attributes;

use common\models\items\IAttribute;

class Size implements IAttribute
{
    protected $value;


    public function getName()
    {
        return 'Целостность';
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getSupportedOperations() {
        return ['eat', 'place', ''];
    }

    public function initValue()
    {
        $this->value = 100;
    }

    public function needsDataToUpdateState()
    {
        return true;
    }

    public function allowUpdataState($operation)
    {
        if ($operation == 'eat') {
            if ($this->value <= 0) {
                return false;
            }
        }
        return true;
    }

    public function updataState($operation, $data = [])
    {
        if ($operation == 'eat') {
            $newSize = $this->value - $data;
            $this->value = ($newSize < 0) ? 0 : $newSize;
        }
    }
}