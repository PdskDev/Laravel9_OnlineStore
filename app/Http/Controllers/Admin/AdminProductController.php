<?php

namespace App\Http\Controllers\Admin;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['menu_active']="product";
        $viewData['title'] = "Admin Page - Products - Online Store";
        //$viewData['products'] = Products::all()->paginate(5);
        $viewData['products'] = Products::orderBy("id", "asc")->paginate(3);
        return view('admin.product.index')->with('viewData', $viewData);
    }

    public function store(Request $request)
    {
        //$request->validate([
        //    "name"=>"required|max:150",
        //    "description"=>"required",
        //    "price"=>"required|numeric|gt:0",
        //    "image"=>"image",
        //]);

        Products::validate($request);

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

    public function edit($id)
    {
        $viewData = [];
        $viewData['title'] = "Admin Page - Edit Product - Online Store";
        $viewData['product'] = Products::findOrFail($id);
        return view('admin.product.edit')->with('viewData', $viewData);
    }

    public function update(Request $request, $id)
    {
        //$request->validate([
        //    "name"=>"required|max:150",
        //    "description"=>"required",
        //    "price"=>"required|numeric|gt:0",
        //    "image"=>"image",
        //]);

        Products::validate($request);

        $product = Products::findOrFail($id);
        $product->setName($request->input("name"));
        $product->setDescription($request->input("description"));
        $product->setPrice($request->input("price"));

        if($request->hasFile('image')){
            $imageName = $product->getId().".".$request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $product->setImage($imageName);
            $product->save();
        }else{
            $product->setImage("game.png");
        }

        $product->save();
        return redirect()->route('admin.product.index')->with('successUpdate', 'The information of product "'.$product->getName().'" has been updated successfully');
    }
}