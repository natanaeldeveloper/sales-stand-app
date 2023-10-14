<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class CustomizeOutputData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $response = $next($request);

        if ($request->json()) {

            $data = json_decode($response->getContent(), true);

            $data['time'] = Carbon::now();

            $response->setContent(json_encode($data));
        }

        return $response;
    }
}