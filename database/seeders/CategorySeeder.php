<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert(
            [
                [
                    'category_name' => 'Webnovel'
                ],
                [
                    'category_name' => 'Light Novel'
                ],
                [
                    'category_name' => 'Comic'
                ]
            ]
        );
    }
}
