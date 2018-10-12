<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cproduct extends Model
{
    protected $fillable = ['id', 'title', 'image', 'description', 'first_invoice', 'price', 'amount'];

    public $timestamps = false;

    public function offers()
    {
        return $this->hasMany('App\Offer', 'product_id', 'id');
    }

    public function categories()
    {
        return $this->hasMany('App\Category', 'product_id', 'id');
    }
}
