<?php

namespace App\Http\Controllers\Admin;

use App\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['menu_active']="product";
        $viewData['title'] = "Admin Page - Products - Online Store";
        $viewData['products'] = Products::all();
        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required|max:150",
            "description"=>"required",
            "price"=>"required|numeric|gt:0",
            "image"=>"image",
        ]);

        $newProduct = new Products();
        $newProduct->setName($request->input("name"));
        $newProduct->setDescription($request->input("description"));
        $newProduct->setPrice($request->input("price"));
        $newProduct->setImage("game.png");
        $newProduct->save();

        return back();
    }
}