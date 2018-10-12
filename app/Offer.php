<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['id', 'product_id', 'price', 'amount', 'sales', 'article'];

    public $timestamps = false;

    public function cproduct()
    {
        return $this->belongsTo('App\Cproduct', 'product_id', 'id');
    }
}
