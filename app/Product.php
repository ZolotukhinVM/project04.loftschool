<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public static function storeProduct($request)
    {
        $product = new Product();
        $product->category_id = $request->category;
        $product->name = htmlentities($request->get('name'));
        $product->price = $request->get('price');
        $product->description = htmlentities($request->get('description'));
        $product->save();
        $newFile = time() . '.' . $request->productfile->extension();
        $request->productfile->move('./upload/products/', $newFile);
        $product->photo = $newFile;
        $product->save();
    }

    public function order()
    {
        return $this->hasOne('App\Order', 'product_id', 'id');
    }
}
