<?php
namespace App\Http\Middleware;
use App\Models\AdminToken;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminTokenAuth {
    public function handle(Request $request, Closure $next): Response {
        $plain = $request->bearerToken();
        if (!$plain) return response()->json(['message' => 'Unauthenticated.'], 401);
        $token = AdminToken::where('token_hash', hash('sha256', $plain))->first();
        if (!$token || $token->expires_at?->isPast()) {
            if ($token) $token->delete();
            return response()->json(['message' => 'Sesi tidak valid.'], 401);
        }
        $request->attributes->set('admin_token', $token);
        return $next($request);
    }
}
