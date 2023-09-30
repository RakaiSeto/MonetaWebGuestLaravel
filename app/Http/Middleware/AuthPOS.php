<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Pos\GetSessionRequest;
use Pos\PosServiceClient;

class AuthPOS
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Log::debug('handleCheckSession');
        if (
            $request->session()->exists('session')
        ) {
            Log::debug("SUCCESS");
            return $next($request);
        } else {
            $request->session()->flush();
            Auth::logout();
            Log::debug('CANNOT LOGIN');
            return redirect('/');
        }
    }
}
?>