<?php

namespace App\Http\Controllers;

use illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData['title'] = "Prestadesk - Online Store";
        
        return view('home.index')->with('viewData', $viewData);
    }

    public function about()
    {

        //$title= "About us - Online Store";
        //$subtitle = "About us";
        //$description = "This is an about page";
        //$author = "Developed by: Prestadesk";

        //return view('home.about')->with('title', $title)
        // ->with('subtitle', $subtitle)
        // ->with('description', $description)
        // ->with('author', $author);
        $viewData = [];
        $viewData['title']= "About us - Online Store";
        $viewData['subtitle'] = "About us";
        $viewData['description'] = "This is an about page";
        $viewData['author'] = "Developed by: Prestadesk";

        return view('home.about')->with('viewData', $viewData);
    }
}