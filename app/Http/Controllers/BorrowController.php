<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        if (!Auth::user()->role()->where('role_name', 'admin')->exists()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'book_id' => 'required',
            'member' => 'required',
            'quantity' => 'required',
            'start_date' => 'required'
        ]);

        $quantity = $request['quantity'];
        $book_id = (int) $request['book_id'];
        $book = Book::find($book_id);

        if (!$book) {
            return redirect('/admin/borrow')->with('danger', 'Book not found!');
        }

        if ($quantity > $book->quantity) {
            return redirect('/admin/borrow')->with('danger', 'The amount that you requested is greater than our stock of the book!');
        }

        $startDate = Carbon::parse($request['start_date']);
        $endDate = $startDate->copy()->addDays(3);

        Borrow::create([
            'book_id' => $request->book_id,
            'user_id' => $request->member,
            'quantity' => $request->quantity,
            'start_borrow' => $request->start_date,
            'end_borrow' => $endDate
        ]);

        $book->update(['quantity' => ($book->quantity - $quantity)]);

        return redirect('/admin/borrow')->with('success', 'The borrowing process is done!');
    }

    public function show(string $id)
    {
        $borrow = Borrow::find($id);
        $books = Book::all();
        $users = User::whereHas('role', function ($query) {
            $query->where('role_name', '=', 'member');
        })->get();

        return view('borrows.edit', compact('borrow', 'books', 'users'))->with('currentPage', 'book');
    }

    public function update(Request $request, string $id)
    {
        if (!Auth::user()->role()->where('role_name', 'admin')->exists()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'book_id' => 'required',
            'member' => 'required',
            'quantity' => 'required',
            'start_date' => 'required'
        ]);

        $borrow = Borrow::find($id);
        $oldQuantity = $borrow->quantity;
        $oldBookId = $borrow->book_id;
        $newQuantity = $request['quantity'];
        $newBookId = (int) $request['book_id'];

        if (empty($newBookId) || $newBookId <= 0) {
            return redirect('/admin/borrow')->with('danger', 'Please select a valid book!');
        }

        if ($oldBookId == $newBookId) {
            $book = Book::find($newBookId);
            if (!$book) {
                return redirect('/admin/borrow')->with('danger', 'Book not found!');
            }

            $quantityDifference = $newQuantity - $oldQuantity;

            if ($quantityDifference > 0) {
                if ($quantityDifference > $book->quantity) {
                    return redirect('/admin/borrow')->with('danger', 'The amount that you requested is greater than our stock of the book!');
                }
                $book->update(['quantity' => ($book->quantity - $quantityDifference)]);
            } elseif ($quantityDifference < 0) {
                $book->update(['quantity' => ($book->quantity - $quantityDifference)]);
            }
        } else {
            $book = Book::find($newBookId);
            if (!$book) {
                return redirect('/admin/borrow')->with('danger', 'Book not found!');
            }

            if ($newQuantity > $book->quantity) {
                return redirect('/admin/borrow')->with('danger', 'The amount that you requested is greater than our stock of the book!');
            }
        }

        $startDate = Carbon::parse($request['start_date']);
        $endDate = $startDate->copy()->addDays(3);

        $borrow->update([
            'book_id' => $request->book_id,
            'user_id' => $request->member,
            'quantity' => $request->quantity,
            'start_borrow' => $request->start_date,
            'end_borrow' => $endDate
        ]);

        return redirect('/admin/borrow')->with('success', 'Borrow record has been successfully updated!');
    }

    public function destroy(string $id)
    {
        if (!Auth::user()->role()->where('role_name', 'admin')->exists()) {
            abort(403, 'Unauthorized');
        }

        $borrow = Borrow::find($id);
        if ($borrow) {
            $book = Book::find($borrow->book_id);
            if ($book) {
                $book->update(['quantity' => ($book->quantity + $borrow->quantity)]);
            }

            $borrow->delete();
        }

        return redirect('/admin/borrow')->with('success', 'Borrow record has been successfully deleted!');
    }
}
