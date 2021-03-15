<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class NotOpenController extends Controller
{
    public function index()
    {
        $data['menus'] = Menu::orderBy('sort_order')->get();
        return view('notopen')->with($data);
    }
}
