<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index () {

        $data['menus'] = Menu::orderBy('sort_order')->get();
        return  view('admin.menu.list')->with($data);
    }
}
