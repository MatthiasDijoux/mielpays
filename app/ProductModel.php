<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = "product";
    protected $fillable = ['name',  'prix', 'image', 'quantite', 'id_producer',];
    public $timestamps = false;

    function producers()
    {
        return $this->belongsTo(ProducerModel::class, 'id_producer');
    }
    function populars()
    {
        return $this->hasMany(PopularProducts::class, 'id_product');
    }
    function orders()
    {
        return $this->belongsToMany(ProductModel::class, 'order_has_product', 'id_order', 'id_product');
    }
}
