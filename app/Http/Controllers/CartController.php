<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $total =0;
        $productsInCart = [];

        $productsInSession = $request->session()->get('products');

        if($productsInSession){
            $productsInCart = Products::findMany(array_keys($productsInSession));
            $total = Products::sumPricesByQuantities($productsInCart, $productsInSession);

            $viewData = [];
            $viewData['title'] = "Cart - Online Store";
            $viewData['subtitle'] = "Shopping Cart";
            $viewData['total'] = $total;
            $viewData['products'] = $productsInCart;
            return view('cart.index')->with('viewData', $viewData);
        }
    }

    public function add(Request $request, $id)
    {
        $products = $request->session()->get('products');
        $products[$id] = $request->input('quantity');
        $request->session()->put('products', $products);

        return redirect()->route('cart.index');
    }

    public function delete(Request $request)
    {
        $request->session()->forget('products');
        //return back();
        return redirect()->route('products.index')->with("successDelete", "Your cart has been emptied");

    }
}