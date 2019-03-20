<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $perPagePage = 10;
    protected $fillable = ['product_id', 'name', 'email'];

    public function product()
    {
        return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
