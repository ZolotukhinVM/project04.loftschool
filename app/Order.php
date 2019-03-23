<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $perPage = 10;
    protected $fillable = ['product_id', 'name', 'email'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
