<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Xanders
 * @see https://team.xsamtech.com/xanderssamoth
 */
class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            if (auth()->user()->status === 'blocked' OR auth()->user()->status === 'disabled') {
                // éviter boucle infinie
                if (!$request->routeIs('blocked.page')) {
                    return redirect()->route('blocked.page')
                        ->with('error', __('miscellaneous.account.' . (auth()->user()->status === 'blocked' ? 'locked' : 'deactivate') . '.title'));
                }
            }
        }

        return $next($request);
    }
}
