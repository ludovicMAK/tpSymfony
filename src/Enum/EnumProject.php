<?php

namespace App\Enum;

enum EnumProject: string
{
    case IN_PROGRESS = 'En cours';
    case FINISHED = 'Fini';
    case PENDING = 'En attente';
}
