<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;

class BookServiceController extends Controller
{
    protected $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    public function index(Request $request)
    {
        if (isset($request->search)) {
            $data = $this->book->search($request->search);

            return response([
                'data' => $data
            ], count($data) > 0 ? 200 : 400);
        }

        return response([
            'data' => $this->book->withCategory()->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|digits:4',
            'quantity' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:1024',
            'category_id' => 'required|integer|exists:categories,id'
        ]);

        if ($request->file('cover')) {
            $filename = Carbon::now()->format('YmdHis') . '.' . $request->file('cover')->extension();
            $request->file('cover')->storeAs('upload', $filename, 'public');
        }

        $this->book->create([
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
            'quantity' => $request->quantity,
            'cover' => $request->file('cover') ? url('/upload', $filename) : null,
            'filename' => $filename,
            'category_id' => $request->category_id
        ]);

        return response([
            'message' => 'New book has been added.'
        ], 201);
    }

    public function show(String $id)
    {
        $data = $this->book->withCategory()->findOrFail($id);
        return response([
            'book' => $data
        ], count($data) > 0 ? 200 : 400);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|digits:4',
            'quantity' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png,svg,webp|max:1024',
            'category_id' => 'required|integer|exists:categories,id'
        ]);

        $filename = '';
        $book = $this->book->findOrFail($id);

        if ($request->file('cover')) {
            // Storage::disk('upload')->delete($book->filename);

            $filename = Carbon::now()->format('YmdHis') . '.' . $request->file('cover')->extension();
            $request->file('cover')->storeAs('upload', $filename, 'public');
        }

        $book->title = $request->title;
        $book->author = $request->author;
        $book->year = $request->year;
        $book->quantity = $request->quantity;
        $book->category_id = $request->category_id;

        if ($request->file('cover')) {
            $book->cover = url('storage/upload/' . $filename);
            $book->filename = $filename;
        }

        $book->save();

        return response([
            'message' => 'This book has been updated.'
        ], 201);
    }

    public function destroy(string $id)
    {
        $book = $this->book->findOrFail($id);
        $book->delete();

        return response([
            'message' => 'This book has been deleted.'
        ], 201);
    }
}
