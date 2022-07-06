<?php

namespace App\Enums;

enum GemTransactionType: int
{
    case DECREASE = 0;
    case INCREASE = 1;
}
