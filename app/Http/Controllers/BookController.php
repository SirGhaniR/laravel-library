<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $books = DB::table('categories')
            ->join('books', 'categories.id', '=', 'books.category_id')
            ->select('books.*', 'categories.category_name')
            ->get();
        $categories = Category::all();
        return view('books.index', compact('books', 'categories'))->with('currentPage', 'book');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->role()->where('role_name', 'admin')->exists()) {
            abort(403, 'Unauthorized');
        }

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

        return redirect('/admin/book')->with('success', 'Book has successfully been added to database!');
    }

    public function show(string $id)
    {
        $books = Book::find($id);
        $categories = Category::all();

        return view('books.edit', compact('books', 'categories'))->with('currentPage', 'book');
    }

    public function update(Request $request, string $id)
    {
        if (!Auth::user()->role()->where('role_name', 'admin')->exists()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'year' => 'required',
            'quantity' => 'required',
            'category' => 'required'
        ]);

        $books = Book::find($id);
        $books->title = $request->title;
        $books->author = $request->author;
        $books->year = $request->year;
        $books->quantity = $request->quantity;
        $books->category_id = $request->category;
        $books->save();

        return redirect('/admin/book')->with('success', 'Book has successfully been updated in database!');
    }

    public function destroy(string $id)
    {
        if (!Auth::user()->role()->where('role_name', 'admin')->exists()) {
            abort(403, 'Unauthorized');
        }

        $books = Book::find($id);
        $books->delete();

        return redirect('/admin/book')->with('success', 'Book has successsfully been deleted in database!');
    }
}
