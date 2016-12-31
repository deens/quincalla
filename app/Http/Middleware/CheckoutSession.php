<?php

namespace Quincalla\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Quincalla\Entities\Checkout;

class CheckoutSession
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param Guard $auth
     *
     * @return void
     */
    public function __construct(Guard $auth, Checkout $checkout)
    {
        $this->auth = $auth;
        $this->checkout = $checkout;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!\Session::has('checkout')) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('checkout/customer');
            }
        }

        return $next($request);
    }
}
