<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $data['menus'] = Menu::orderBy('sort_order')->get();
        return view('admin.index')->with($data);
    }}
