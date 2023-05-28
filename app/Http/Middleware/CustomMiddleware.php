<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class CustomMiddleware
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle($request, Closure $next)
    {
        $key = 'custom_throttle_' . $request->route('post');

        $maxAttempts = 2;
        $decaySeconds = 20;

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            $retryAfter =$this->limiter->availableIn($key);

            return new Response('Too Many Requests.', 429, ['Retry-After' => $retryAfter]);
        }

    $this->limiter->hit($key, $decaySeconds);

        return $next($request);
    }
}



