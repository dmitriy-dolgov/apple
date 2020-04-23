<?php

namespace common\models\items;

interface IAttribute
{
    public function getName();

    public function getValue();

    public function getSupportedOperations();


    public function initValue();


    public function needsDataToUpdateState();


    public function allowUpdataState(string $operation);

    public function updataState(string $operation, $data = []);
}