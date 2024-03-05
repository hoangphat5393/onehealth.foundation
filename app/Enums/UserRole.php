<?php

// declare(strict_types=1);

namespace App\Enums;

enum UserRole: int
{
    case SuperAdmin = 0;
    case Admin = 1;
    case Editor = 2;
}
