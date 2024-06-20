<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowedOrigins = ['http://localhost:3000','http://127.0.0.1:3000','http://app.hadathah.org','https://app.hadathah.org'];
        $origin = $request->headers->get('origin');

        $response = $next($request);
        if (in_array($origin, $allowedOrigins)) {
            $headers = [
                'Access-Control-Allow-Origin'      => $origin,
                'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Credentials' => 'true',
                'Access-Control-Max-Age'           => '86400',
                'Access-Control-Allow-Headers'     => 'Content-Type, Authorization, X-Requested-With'
            ];

            if ($request->isMethod('OPTIONS')) {
                return response()->json('{"method":"OPTIONS"}', 200, $headers);
            }

            // Check if the response is a StreamedResponse
            if ($response instanceof StreamedResponse) {
                foreach ($headers as $key => $value) {
                    $response->headers->set($key, $value);
                }
            } else {
                foreach ($headers as $key => $value) {
                    $response->header($key, $value);
                }
            }
        }

        return $response;
    }
}