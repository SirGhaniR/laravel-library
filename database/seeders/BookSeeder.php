<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::insert(
            [
                [
                    'title' => 'Lord of The Mysteries',
                    'author' => 'Cuttlefish That Loves Diving',
                    'year' => 2018,
                    'quantity' => 100,
                    'cover' => null,
                    'filename' => null,
                    'category_id' => 1
                ],
                [
                    'title' => 'Shadow Slave',
                    'author' => 'Guiltythree',
                    'year' => 2022,
                    'quantity' => 100,
                    'cover' => null,
                    'filename' => null,
                    'category_id' => 1
                ],
                [
                    'title' => 'Reverend Insanity',
                    'author' => 'Gu Zhen Ren',
                    'year' => 2013,
                    'quantity' => 100,
                    'cover' => null,
                    'filename' => null,
                    'category_id' => 1
                ]
            ]
        );
    }
}
