<?php

namespace common\models\items;

interface IAttribute
{
    public function getName();

    public function getValue();


    public function initValue();


    public function canDo(&$attributes, $operation);

    public function do();
}