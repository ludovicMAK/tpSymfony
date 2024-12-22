<?php

namespace App\Enum;

enum EnumTaskStatus: string
{
    case IN_PROGRESS = 'En cours';
    case FINISHED = 'Fini';
    case PENDING = 'En attente';
}
