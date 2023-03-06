<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Http\Resources\BookResource;
use App\Http\Resources\BooksResource;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('user:id,username')->get(); // no space in with()
        return BooksResource::collection($books);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'description' => 'max:1000',
        ]); // header request => Accept = application/json and use raw->json input in postman
        $validated['user_id'] = Auth::user()->id;
        // $validated['user_id'] = 1;
        $book = Book::create($validated);
        return new BookResource($book->loadMissing('user:id,username'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return Book::with('user')->findOrfail($id);
        $book = Book::with('user:id,username')->findOrFail($id);
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'title' => 'max:100',
            'description' => 'max:1000',
        ]);
        $book = Book::findOrFail($id);
        $book->update($validated);
        return new BookResource($book->loadMissing('user:id,username'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return new BookResource($book->loadMissing('user:id,username'));
    }
}
