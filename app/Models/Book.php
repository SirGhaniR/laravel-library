<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'year',
        'quantity',
        'cover',
        'filename',
        'category_id'
    ];

    public function withCategory()
    {
        return $this->join('categories', function (JoinClause $join) {
            $join->on('books.category_id', '=', 'categories.id');
        })->select(
            'books.id',
            'categories.category_name',
            'books.title',
            'books.author',
            'books.quantity',
            'books.year'
        );
    }

    public function search($param)
    {
        return $this->join('categories', function (JoinClause $join) {
            $join->on('books.category_id', '=', 'categories.id');
        })
            ->where('title', 'like', `%$param%`)
            ->orWhere('categories.category_name', 'like', `%$param%`)
            ->select(
                'books.id',
                'categories.category_name',
                'books.title',
                'books.author',
                'books.quantity',
                'books.year'
            )->get();
    }
}
