<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CategoryRequest;
use App\Product;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('id', 'desc')->paginate();
        return view('admin.category.index', compact('category'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->only(['name', 'description']));
        return redirect()->route('category');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update($id, CategoryRequest $request)
    {
        Category::findOrFail($id)->update($request->only(['name', 'description']));
        return redirect()->route('category');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->route('category');
    }

    public function show(Category $category)
    {
        //$products = $category->products()->paginate();
        $products = Product::where('category_id', $category->id)->paginate();
        return view('user.category.show', compact('category', 'products'));
    }
}
