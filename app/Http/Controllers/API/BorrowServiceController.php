<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BorrowServiceController extends Controller
{
    protected $book, $borrow, $user;

    public function __construct(Book $book, Borrow $borrow, User $user)
    {
        $this->book = $book;
        $this->borrow = $borrow;
        $this->user = $user;
    }

    public function index(Request $request)
    {
        $role = $request->user()->load('role');

        if ($role->role[0]->role_name == 'admin') {
            $borrowList = $this->borrow->with('users', 'books')->get();

            if (!$borrowList) {
                return response([
                    'data' => $borrowList,
                    'message' => "Borrow list is empty!"
                ], 200);
            }

            return response([
                'data' => $borrowList,
                'message' => "Borrow list found!"
            ], 200);
        }

        return response([
            'message' => "Borrow list can only be seen by admins!"
        ], 401);
    }

    public function store(Request $request)
    {
        $role = $request->user()->load('role');

        if ($role->role[0]->role_name == 'admin') {
            $request->validate([
                'book_id' => 'required|exists:books,id',
                'member_id' => 'required|exists:memberships,id'
            ]);

            $borrowList = $this->borrow->where([
                'book_id' => $request->book_id,
                'member_id' => $request->member_id
            ])->first();

            if ($borrowList && !isset($borrowList->return_borrow)) {
                return response([
                    'data' => $borrowList,
                    'message' => "Book is still being borrowed!"
                ], 422);
            }

            $borrowDate = new Carbon;
            $borrowData = $this->borrow->create([
                'book_id' => $request->book_id,
                'member_id' => $request->member_id,
                'quantity' => 1,
                'start_borrow' => $borrowDate->now(),
                'end_borrow' => $borrowDate->addDays(3),
                'fine' => 0
            ]);

            $bookQuantity = $this->book->find($borrowData->book_id);
            $bookQuantity->quantity -= 1;
            $bookQuantity->save();

            return response([
                'data' => $borrowData,
                'message' => "New borrow has been created!!"
            ], 201);
        }

        return response([
            'message' => "Borrow can only be created by admins!"
        ], 401);
    }

    public function show(string $id)
    {
        $data = $this->borrow->findOrFail($id);
        return response([
            'data' => $data,
        ], count($data) > 0 ? 200 : 400);
    }

    public function update(Request $request, string $id)
    {
        $date = new Carbon();

        $role = $request->user()->load('role');

        if ($role->role[0]->role_name == 'admin') {
            $borrowData = $this->borrow->findOrFail($id);

            $dayEnded = $date->parse($borrowData->end_borrow);
            $dayReturned = $date->parse($date->now());

            if (isset($borrowData->return_borrow)) {
                return response([
                    'data' => $borrowData,
                    'message' => 'The book that was borrowed has been returned!'
                ], 422);
            }

            $borrowData->return_borrow = $date->now();

            if ($dayEnded < $dayReturned) {
                $dayDifference = $dayEnded->diffInDays($dayReturned);
                $borrowData->fine = floor($dayDifference) * 1000;
            }

            $borrowData->save();

            $bookQuantity = $this->book->find($borrowData->book_id);
            $bookQuantity->quantity += 1;
            $bookQuantity->save();

            return response([
                'message' => 'This book has been returned.'
            ], 201);
        }

        return response([
            'message' => "Borrow can only be updated by admins!"
        ], 401);
    }

    public function destroy(Request $request, string $id)
    {
        $role = $request->user()->load('role');

        if ($role->role[0]->role_name == 'admin') {
            $borrowData = $this->borrow->findOrFail($id);
            $borrowData->delete();

            $bookQuantity = $this->book->find($borrowData->book_id);
            $bookQuantity->quantity += 1;
            $bookQuantity->save();

            return response([
                'message' => 'This borrow request has been deleted.'
            ], 201);
        }

        return response([
            'message' => "Borrow can only be deleted by admins!"
        ], 401);
    }
}
