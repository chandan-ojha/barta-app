<?php

declare(strict_types=1);

namespace App\Filters\Components;

use Closure;

class User implements ComponentInterface
{
    public function handle(array $content, Closure $next): mixed
    {
        if (isset($content['params']['first_name']) && isset($content['params']['last_name'])) {
            $first_name = $content['params']['first_name'];
            $last_name = $content['params']['last_name'];
            $content['builder']->where(function ($query) use ($first_name, $last_name) {
                $query->where('first_name', 'like', '%' . $first_name . '%')
                    ->where('last_name', 'like', '%' . $last_name . '%');
            });
        }
        return $next($content);
    }
}
