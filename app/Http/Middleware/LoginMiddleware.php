<?php namespace App\Http\Middleware;

use Closure;

class LoginMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeInfo = $request->route();
        $identifier_id = array_get($routeInfo[2], 'identifier_id');
        $session_identifier_id = $request->session()->get('identifier_id');

        if($identifier_id != $session_identifier_id) {
            return redirect('/');
        }

        return $next($request);
    }

}
