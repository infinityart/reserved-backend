<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class responseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if($response->status() !== Response::HTTP_OK ) return $response;

        $data = $response->getData();

        $data->success = true;
        $data->status = Response::HTTP_OK;

        $response->setData($data);

        return $response;
    }
}
