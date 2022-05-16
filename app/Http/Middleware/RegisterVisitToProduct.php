<?php

namespace App\Http\Middleware;

use App\Jobs\AddVisitToProductJob;
use App\Models\Product;
use Closure;
use Illuminate\Http\Request;

class RegisterVisitToProduct
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
        if ($request->route()->hasParameter('slug')) {
            $product = Product::query()
                ->where('slug', $request->route()->parameter('slug'))
                ->firstOrFail('id');
            dispatch(new AddVisitToProductJob($product->id));
        }

        return $next($request);
    }
}
