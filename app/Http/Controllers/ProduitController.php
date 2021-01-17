<?php

namespace App\Http\Controllers;

use App\Http\Resources\PopularProductsResource;
use App\Http\Resources\ProductResource;
use App\PopularProducts;
use App\ProductModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function modify(Request $request, $id)
    {
        $product = ProductModel::where('id', $id)->first();
        $datas = Validator::make(
            $request->input(),
            [
                'quantite' => 'required|numeric',
                'name' => 'required',
                'prix' => 'required|numeric',
            ]
        )->validate();
        $product->quantite = $datas['quantite'];
        $product->name = $datas['name'];
        $product->prix = $datas['prix'];
        $product->save();
        return new ProductResource($product);
    }
    public function add(Request $request, $id)
    {
        $datas = Validator::make(
            $request->input(),
            [
                'quantite' => 'required|numeric',
                'name' => 'required',
                'prix' => 'required|numeric',
            ]
        )->validate();
        $product = new ProductModel();
        $product->quantite = $datas['quantite'];
        $product->name = $datas['name'];
        $product->prix = $datas['prix'];
        $product->id_producer = $id;
        $product->save();
        return new ProductResource($product);
    }
    public function getPopular()
    {
        $products = PopularProducts::orderBy('quantite_acheté', 'DESC')->get();
        return PopularProductsResource::collection($products);
    }
    public function getAll()
    {
        $products = ProductModel::get();
        return ProductResource::collection($products);
    }
    public function delete($id)
    {
        $products = ProductModel::where('id', $id)->first();
        $status = 'nok';
        if (!$products) {
            $status = 'ok';
        } else {
            $products->populars()->delete();
            $products->delete();
        }
        return ['status' => $status];
    }
}
