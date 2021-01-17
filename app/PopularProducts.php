<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopularProducts extends Model
{
    protected $table = "popularProducts";
    protected $fillable = ['quantite_acheté'];
    public $timestamps = false;

    function product()
    {
        return $this->belongsTo(ProductModel::class, 'id_product');
    }
}
