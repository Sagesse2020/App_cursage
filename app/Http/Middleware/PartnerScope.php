<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PartnerScope
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        // si l'utilisateur est partenaire lié à un partenaire
        if($user && $user->role === 'partner'){
            // on attache l'objet partenaire à la requête pour controllers
            $request->attributes->set('partenaire_user', $user->partenaire ?? null);
        }
        return $next($request);
    }
}
