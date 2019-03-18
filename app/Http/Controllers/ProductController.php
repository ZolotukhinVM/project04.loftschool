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
        return view('admin.product.index', ["products" => $products]);
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
        return view('admin.product.edit', ['product' => $product, 'category' => Category::orderBy('id')->get(['id', 'name'])]);
    }

    public function update($id, ProductRequest $request)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        if ($request->productfile) {
            $request->productfile->store('uploads', 'public');
            $product->photo = $request->productfile->hashName();
            $product->save();
        }
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
        Product::find($product->id)->increment('view');
        return view('user.product.detail', ['product' => $product]);
    }
}
