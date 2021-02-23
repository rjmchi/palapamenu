<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use App\Category;
use App\Item;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $data['menus'] = Menu::orderBy('sort_order')->get();
        // return view('admin.index')->with($data);
        return view('admin.index');
    }

    public function menus()
    {
        $data['menus'] = Menu::orderBy('sort_order')->get();
        return view('newadmin.menulist')->with($data);
    }

    public function categories()
    {
        $data['categories'] = Category::orderBy('sort_order')->get();
        return view('newadmin.categorylist')->with($data);
    }

    public function items()
    {
        $data['items'] = Item::orderBy('sort_order')->get();
        return view('newadmin.itemlist')->with($data);
    }
}
