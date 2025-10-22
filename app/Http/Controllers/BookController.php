<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $datas = Book::all();
        $categories = Category::all();
        return view('books.index', compact('datas', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:books,title',
            'author' => 'required',
            'year' => 'required',
            'quantity' => 'required',
            'category' => 'required'
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
            'quantity' => $request->quantity,
            'category_id' => $request->category
        ]);

        return redirect('/book')->with('success', 'Book has successfully been added to database!');
    }

    public function show(string $id)
    {
        $data = Book::find($id);
        return view('books.edit', compact('data'));
    }

    public function update(Request $request, string $id)
    {
        $categories = Category::all();

        $request->validate([
            'title' => 'required|unique:books,title',
            'author' => 'required',
            'year' => 'required',
            'quantity' => 'required',
            'category' => 'required'
        ]);

        $data = Book::find($id);
        $data->title = $request->title;
        $data->author = $request->author;
        $data->year = $request->year;
        $data->quantity = $request->quantity;
        $data->category_id = $request->category_id;
        $data->save();

        return redirect('/book')->with('success', 'Book has successfully been updated in database!');
    }

    public function destroy(string $id)
    {
        $data = Book::find($id);
        $data->delete();

        return redirect('/book')->with('success', 'Category has successsfully been deleted in database!');
    }
}
