<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProducteurResource;
use App\Http\Resources\ProductResource;
use App\ProducerModel;
use App\ProductModel;
use Illuminate\Http\Request;

class ProducteurController extends Controller
{
    public function Index($id)
    {
        $products = ProductModel::where('id_producer', $id)->get();
        return ProductResource::collection($products);
    }
    public function getAll()
    {
        $producteurs = ProducerModel::get();
        return ProducteurResource::collection($producteurs);
    }
}
