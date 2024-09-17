<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isadmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
   */
  public function handle(Request $request, Closure $next): Response
  {

    if (auth()->user()->role == 'admin') {
      return $next($request);
    } elseif (auth()->user()->role == 'renter') {

      return redirect(route('home'));
    } else {
      return redirect(route('no-access'));
    }
  }
}
