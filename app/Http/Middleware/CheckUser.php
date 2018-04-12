<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Discussion;

class CheckUser
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
        $discussion=Discussion::where('slug', '=', $request->slug)->first();
        if ($discussion->user==auth()->user()) {
            return $next($request);
        }
        
        return back();
    }
}
