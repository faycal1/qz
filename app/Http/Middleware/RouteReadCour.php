<?php

namespace App\Http\Middleware;

use Auth ;
use Request;
use Closure;
use App\Models\Quiz\Cour\Cour ; 

class RouteReadCour
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
        $cour = Cour::where('slug',Request::segment(2))->first() ;
        $departements = $cour->selectedDepartement($cour->departements->toArray()) ;
        $collection = collect( $departements);
        if (!$collection->contains(Auth::user()->departement_id))
            return redirect('/')->withFlashDanger("You do not have access to do that.");
        return $next($request);

    }
}
