<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        else
        {
            $viewData = [];
            $viewData['title'] = "Empty cart - Online Store";
            $viewData['subtitle'] = "Empty shopping cart";
            $viewData['products'] = "";
            $viewData['message_empty_cart1'] = "Shopping cart is empty";
            $viewData['message_empty_cart2'] = "Your shopping cart contains 0 product. Please browse our catalog by clicking on the button below.";
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

    public function purchase(Request $request)
    {
        $productsInSession = $request->session()->get("products");

        if ($productsInSession) {
            $userId = Auth::user()->getId();
            $order = new Order();
            $order->setUserId($userId);
            $order->setTotal(0);
            $order->save();

            $total = 0;
            $productsInCart = Products::findMany(array_keys($productsInSession));

            foreach ($productsInCart as $product) {
                $quantity = $productsInSession[$product->getId()];

                $item = new Item();
                $item->setQuantity($quantity);
                $item->setPrice($product->getPrice());
                $item->setProductId($product->getId());
                $item->setOrderId($order->getId());
                $item->save();

                $total = $total + ($product->getPrice() * $quantity);
            }

            $order->setTotal($total);
            $order->save();

            $newBalance = Auth::user()->getBalance() - $total;
            Auth::user()->setBalance($newBalance);
            Auth::user()->save();

            $request->session()->forget('products');

            $viewData = [];
            $viewData['title'] = "Purchase - Online Store";
            $viewData['subtitle'] = "Online payment - Stripe";
            $viewData['amount'] = $total;
            $viewData['order'] = $order;
            
            return view("cart.purchase")->with('viewData', $viewData);

            //return view("stripe.index")->with('viewData', $viewData);
        }else{
            return redirect()->route('cart.index');
        }
    }
}