<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(10);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        return view('admin.product.create', ['category' => Category::orderBy('id')->get(['id', 'name'])]);
    }

    public function store(ProductRequest $request)
    {
        Product::storeProduct($request);
        return redirect()->route('product');
    }

    public function edit(Product $product)
    {
        $category = Category::orderBy('id')->get(['id', 'name']);
        return view('admin.product.edit', compact('product', 'category'));
    }

    public function update($id, ProductRequest $request)
    {
        Product::updateProduct($id, $request);
        return redirect()->route('product');
    }

    public function destroy($id)
    {
        Storage::disk('public')->delete('uploads/' . Product::find($id)->photo);
        Product::destroy($id);
        return redirect()->route('product');
    }

    public function detail(Product $product)
    {
        $product->increment('view');
        return view('user.product.detail', compact('product'));
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->s . '%')->paginate(6);
        return view('user.search.result', compact('products'));
    }
}
