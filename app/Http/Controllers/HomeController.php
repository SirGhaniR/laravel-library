<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $datas = Category::all();
        return view('home', compact('datas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        Category::create([
            'category_name' => $request->category_name
        ]);

        return redirect('/home')->with('success', 'Category has successfully been added to database!');
    }

    public function edit($id)
    {
        $data = Category::find($id);
        return view('categories.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);

        $data = Category::find($id);
        $data->category_name = $request->category_name;
        $data->save();

        return redirect('/home')->with('success', 'Category has successfully been updated in database!');
    }

    public function destroy($id)
    {
        $data = Category::find($id);
        $data->delete();

        return redirect('/home')->with('success', 'Category has successsfully been deleted in database!');
    }
}
