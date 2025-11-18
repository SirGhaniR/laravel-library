<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $datas = Category::all();
        return view('categories.index', compact('datas'))->with('currentPage', 'book');
    }

    public function store(Request $request)
    {
        if (!Auth::user()->role()->where('role_name', 'admin')->exists()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect('/admin/category')->with('success', 'Category has successfully been added to database!');
    }

    public function show($id)
    {
        $data = Category::find($id);
        return view('categories.edit', compact('data'))->with('currentPage', 'book');
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()->role()->where('role_name', 'admin')->exists()) {
            abort(403, 'Unauthorized');
        }

        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        $data = Category::find($id);
        $data->category_name = $request->category_name;
        $data->save();

        return redirect('/admin/category')->with('success', 'Category has successfully been updated in database!');
    }

    public function destroy($id)
    {
        if (!Auth::user()->role()->where('role_name', 'admin')->exists()) {
            abort(403, 'Unauthorized');
        }

        $data = Category::find($id);
        $data->delete();

        return redirect('/admin/category')->with('success', 'Category has successsfully been deleted in database!');
    }
}
