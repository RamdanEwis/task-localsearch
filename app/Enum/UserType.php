<?php

namespace App\Enum;

enum UserType :string
 {
    case SUPER_ADMIN = 'super_admin';
    case USER = 'user';
}
