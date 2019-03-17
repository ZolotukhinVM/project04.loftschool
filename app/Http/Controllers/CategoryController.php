<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::orderBy('id', 'desc')->paginate(10);
        return view('admin.category.index', ['category' => $data]);
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());
        return redirect()->route('category');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['category' => $category]);
    }

    public function update($id, CategoryRequest $request)
    {
        Category::find($id)->update($request->all());
        return redirect()->route('category');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('category');
    }

    public function show(Category $category)
    {
        return view('user.category.show', [
            'products' => $category->products()->paginate(6),
            'category' => $category
        ]);
    }
}
