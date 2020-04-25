<?php

namespace common\models\items;

/**
 * Сигнал что функция не может быть выполнена.
 * Коды:
 *      1  - функция которую пытались вызвать отсутствует.
 *      2  - вызов функции запрещен (сама функция при этом существует).
 *
 * Class SignalFunction
 * @package common\models\items
 */
class SignalFunction extends \Exception
{
}
