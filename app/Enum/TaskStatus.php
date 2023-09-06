<?php

namespace App\Enum;

enum TaskStatus :string
 {
    case PROCESSING = 'processing';
    case SUCCESS = 'success';
}
