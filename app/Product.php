<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $perPage = 9;

    public static function storeProduct($request)
    {
        $product = new Product();
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $request->productfile->store('uploads', 'public');
        $product->photo = $request->productfile->hashName();
        $product->save();
    }

    public static function updateProduct($id, $request)
    {
        $product = Product::find($id);
        $product->category_id = $request->category;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();
        if ($request->productfile) {
            $request->productfile->store('uploads', 'public');
            $product->photo = $request->productfile->hashName();
            $product->save();
        }
    }

    public function getPhoto()
    {
        return $this->photo ?? 'example.jpg';
    }

    public function order()
    {
        return $this->hasOne('App\Order', 'product_id', 'id');
    }
}
