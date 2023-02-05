<?php

namespace App\Enums;

enum EnTodoStatus: string
{
    case HOLD = 'HOLD';
    case IN_PROGRESS = 'IN PROGRESS';
    case COMPLETED = 'COMPLETED';
    case CANCELLED = 'CANCELLED';
}
