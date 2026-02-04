<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $fillable = [
        'book_id',
        'member_id',
        'quantity',
        'start_borrow',
        'end_borrow',
        'return_borrow',
        'fine'
    ];
}
