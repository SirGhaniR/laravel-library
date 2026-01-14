<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookServiceController extends Controller
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        return response([
            "data" => $this->book->withCategory()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|digits:4',
            'quantity' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:1024',
            'category' => 'required|integer|exists:categories,id'
        ]);

        if ($request->file('cover')) {
            $filename = Carbon::now() . '.' . $request->file('cover')->extension();
            $request->file('cover')->move(public_path('upload/'), $filename);
        }

        $this->book->create([
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
            'quantity' => $request->quantity,
            'cover' => url('/upload/', $filename),
            'category_id' => $request->category
        ]);

        return response([
            "message" => "New book have been added."
        ], 201);
    }

    public function show(String $id)
    {
        $data = $this->book->withCategory()->find($id);
        return response([
            "book" => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
