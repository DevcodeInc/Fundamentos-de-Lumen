<?php
namespace App\Http\Middleware;

use Closure;
use Validator;

class ValidationMiddleware
{
    public function handle($request, Closure $next)
    {
        $request->method();
        //$request->input('product_id');
        $validate = Validator::make($request->all(), [
           'product_id' => 'required',
            'status'    => 'required'
        ]);

        if($validate->fails()){
            return response()->json([
                'status' => 'invalid',
                'errors' => $validate->errors()->all()
            ], 401);
        }
        return $next($request);
    }
}