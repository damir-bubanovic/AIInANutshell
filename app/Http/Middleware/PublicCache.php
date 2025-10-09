<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PublicCache
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $seconds = 600)
    {
        if (!in_array($request->method(), ['GET','HEAD'])) {
            return $next($request);
        }

        $response = $next($request);

        $etag = md5($response->getContent() ?? '');
        if ($request->headers->get('If-None-Match') === $etag) {
            return response('', 304)->withHeaders([
                'ETag' => $etag,
                'Cache-Control' => "public, max-age={$seconds}, s-maxage={$seconds}",
            ]);
        }


        return $response
            ->header('Cache-Control', "public, max-age={$seconds}, s-maxage={$seconds}")
            ->header('ETag', $etag);
    }
    
}
