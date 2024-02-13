<?php

declare(strict_types=1);

namespace App\Filters\Components;

use Closure;

class Body implements ComponentInterface
{
    public function handle(array $content, Closure $next): mixed
    {
        if (isset($content['params']['body'])) {
            $value = $content['params']['body'];
            $content['builder']->where('body', 'like', '%' . $value . '%');
        }
        return $next($content);
    }
}
