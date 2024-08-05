<?php

namespace Reactphp\Framework\Middleware;

use React\Http\Message\Response;
use function React\Promise\resolve;


class CrosMiddleware
{
    public function __invoke($request, $next) {
        $withHeaders = [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => '*',
            'Access-Control-Allow-Headers' => '*',
            'Access-Control-Expose-Headers' => '*',
        ];

        if ($request->getMethod() == 'OPTIONS') {
            return new Response(200, $withHeaders, 'OK');
        }

        return resolve($next($request))->then(
            function ($response) use ($withHeaders) {
                foreach ($withHeaders as $key => $value) {
                    if (!$response->hasHeader($key)) {
                        $response = $response->withHeader($key, $value);
                    }
                }
                return $response;
            }
        );
    }
}