<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id', 'order_number'];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
}
