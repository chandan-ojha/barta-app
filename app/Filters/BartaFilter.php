<?php

namespace App\Filters;

use App\Filters\Components\Body;
use App\Filters\Components\User;

class BartaFilter extends BaseFilter
{
    protected function getFilters(): array
    {
        return [
            Body::class,
            //User::class,
        ];
    }

}
