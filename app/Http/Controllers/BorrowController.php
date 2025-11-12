<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Borrow;
use App\Models\Book;
use App\Models\User;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::join('books', 'borrows.book_id', '=', 'books.id')
            ->join('users', 'borrows.user_id', '=', 'users.id')
            ->select('borrows.*', 'books.title', 'users.name')
            ->get();
        $books = Book::all();
        $users = User::whereHas('role', function ($query) {
            $query->where('role_name', '=', 'member');
        })->get();

        return view('borrows.index', compact('borrows', 'books', 'users'))->with('currentPage', 'book');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'member' => 'required',
            'quantity' => 'required',
            'start_date' => 'required'
        ]);

        $quantity = $request['quantity'];
        $title = $request['title'];
        $books = Book::where('id', '=', $title)->get('quantity');
        foreach ($books as $book) {
            if (!$book) {
                return redirect('/admin/borrow')->with('danger', 'Book not found!');
            }

            if ($quantity > $book->quantity) {
                return redirect('/admin/borrow')->with('danger', 'The amount that you requested is greater than our stock of the book!');
            }

            $startDate = Carbon::parse($request['start_date']);
            $endDate = $startDate->copy()->addDays(3);

            Borrow::create([
                'book_id' => $request->title,
                'user_id' => $request->member,
                'quantity' => $request->quantity,
                'start_borrow' => $request->start_date,
                'end_borrow' => $endDate
            ]);

            // $book_updated = Book::update(['quantity' => ($book->quantity - $quantity)]);
        }

        return redirect('/admin/borrow')->with('success', 'The borrowing process is done!');
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $borrows = Borrow::find($id);
        $borrows->delete();

        return redirect('/admin/borrow')->with('success', 'Book has successsfully been deleted in database!');
    }
}
