<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Category extends Enum
{
    const Management = 'Managed';
    const NonManagement = 'Exclusively Marketed Villas';
}
