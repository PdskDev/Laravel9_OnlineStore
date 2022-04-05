<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //public static $products = [
    //    ["id"=>"1", "name"=>"TV", "description"=>"Best TV", "image"=>"game.png", "price"=>"1000"],
    //    ["id"=>"2", "name"=>"Iphone", "description"=>"Best Iphone", "image"=>"safe.png", "price"=>"999"],
    //    ["id"=>"3", "name"=>"Chromecast", "description"=>"Best Chromecast", "image"=>"submarine.png", "price"=>"30"],
    //    ["id"=>"4", "name"=>"Glasses", "description"=>"Best Glasses", "image"=>"game.png", "price"=>"100"]
    //];

    public function index()
    {
        $viewData = [];
        $viewData['title'] = "Products - Online Store";
        $viewData['subtitle'] = "List of products";
        //$viewData['products'] = ProductsController::$products;
        $viewData['products'] = Products::all();
        return view('products.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        //$product = ProductsController::$products[$id-1];
        $viewData = [];
        $product = Products::findOrFail($id);
        //$viewData['title'] = $product["name"]." - Online Store";
        //$viewData['subtitle'] = $product["name"]." - Product information";
        $viewData['title'] = $product->getName()." - Online Store";
        $viewData['subtitle'] = $product->getName()." - Product information";
        $viewData['product'] = $product;
        return view('products.show')->with("viewData", $viewData);
    }
}
