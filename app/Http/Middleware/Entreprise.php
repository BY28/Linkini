<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class Entreprise
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
        if($request->user()->entreprise != null)
        { 
            if($request->user()->entreprise->checked)
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('entreprises.waiting')->withInfo('Veuillez payer ou renouveler votre abonnement pour pouvoir accéder à toutes les fonctionnalités');
            }
        }
        return redirect()->route('entreprises.waiting')->withInfo('Entreprise en attente d\'être accepté');
    }
}
