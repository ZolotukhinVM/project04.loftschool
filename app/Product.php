<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'price', 'description', 'photo'];
    protected $perPage = 9;

    public function getPhoto()
    {
        return $this->photo ?? 'example.jpg';
    }
}
