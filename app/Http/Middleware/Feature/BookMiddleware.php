<?php

namespace App\Http\Middleware\Feature;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class BookMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $current_user = Auth::user();
        $book_user = Book::findOrFail($request->id);
        if($current_user->id != $book_user->user_id){
            return response()->json(["message" => "data not found"]);
        }
        return $next($request);
    }
}
