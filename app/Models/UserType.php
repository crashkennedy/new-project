<?php

declare(strict_types=1);

namespace App\Models;

Enum UserType: string {
    case ADMIN = 'Admin';
    case USER = 'User';
}