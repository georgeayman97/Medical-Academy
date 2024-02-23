<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignedIn
{
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user())
            return redirect()->route('login');
    }
}
