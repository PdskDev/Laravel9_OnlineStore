<?php

namespace App\Http\Controllers\Admin;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
        //$newProduct->setImage("game.png");
        $newProduct->save();

        if($request->hasFile('image')){
            $imageName = $newProduct->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $newProduct->setImage($imageName);
            $newProduct->save();
        }else{
            $newProduct->setImage("game.png");
        }

        $newProduct->save();

        //Alternative method
        //$creationData = $request->only(["name", "description", "price"]); // work with fillable enable in model object
        //$creationData["image"] = "game.png";
        //Products::create($creationData);

        return back()->with("successAdd", "The product \"$request->name\" has just been successfully added");
    }

    public function delete($id)
    {
        Products::destroy($id);
        return back()->with("successDelete", "The product has been permanently deleted");
    }
}