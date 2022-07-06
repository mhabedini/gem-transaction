<?php

namespace App\Exceptions;

use Exception;

class NoEnoughGemException extends Exception
{
    public function __construct()
    {
        parent::__construct(__('exception.1001'), 1001);
    }
}
