<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryServiceController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return response([
            'data' => $this->category->all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        $this->category->create([
            'category_name' => $request->category_name
        ]);

        return response([
            'message' => 'New category have been added.'
        ], 201);
    }

    public function show(string $id)
    {
        $data = $this->category->findOrFail($id);
        return response([
            'category' => $data
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        $data = $this->category->findOrFail($id);
        $data->category_name = $request->category_name;
        $data->save();

        return response([
            'message' => 'This category has been updated.'
        ], 201);
    }


    public function destroy(string $id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();

        return response([
            'message' => 'This category has been deleted.'
        ], 201);
    }
}
