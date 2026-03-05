<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsurePromptQuota
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ! $user->canCreatePrompt()) {
            return redirect()->route('dashboard')
                ->with('error', 'Has alcanzado el límite de 5 prompts del plan gratuito.');
        }

        return $next($request);
    }
}
