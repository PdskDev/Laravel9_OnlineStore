<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use illuminate\Support\Facades\Auth;

class MyAccountController extends Controller
{
    public function orders()
    {
        $viewData = [];
        $viewData['title'] = "My Orders - Online Store";
        $viewData['subtitle'] = "My Orders";
        //Lazy loading
        //$viewData['orders'] = Order::where('user_id', Auth::user()->getId())->get();

        //Eager loading
        $viewData['orders'] = Order::with(['items.product'])->where('user_id', Auth::user()->getId())->get();
        return view('myaccount.orders')->with('viewData', $viewData);
    }
}