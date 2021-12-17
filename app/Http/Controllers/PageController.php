<?php

namespace App\Http\Controllers;
use App\Models\Page;

class PageController extends Controller
{

    public function welcome() // get welcome page
    {
       $page = Page::findOrFail(1);
       return view('page', compact('page'));
    }
    public function consultation() // get consultation page
    {
        $page = Page::findOrFail(2);
        return view('page', compact('page'));
    }
}
