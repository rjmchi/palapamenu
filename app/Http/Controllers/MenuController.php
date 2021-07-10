<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use App\Http\Resources\MenuResource;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::orderBy('sort_order')->get();
        // return $menu;
        return MenuResource::collection($menu);
    }

    public function list()
    {
        $menu = Menu::orderBy('sort_order')->get();
        $data['menus'] = $menu;
        return view('listMenu')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return 'unauthorized';
        }
        $menu_data = [
            'en' => ['name'  => $request->en_name],
            'es' => ['name' => $request->es_name,],
            'sort_order' => $request->sort_order
        ];
        $m = Menu::create($menu_data);
        if ($request->web == true) {
            return redirect(route('admin.menulist'));
        }
        return new MenuResource($m);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        return new MenuResource($menu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        $data['menu'] = $menu;
        return view('newadmin.menuedit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $menu_data = [
            'en' => ['name'  => $request->en_name,],
            'es' => ['name' => $request->es_name,],
            'sort_order' => $request->sort_order
        ];
        $menu->update($menu_data);
        if ($request->web == true) {
            return redirect(route('admin.menuedit', $menu->id));
        }
        return new MenuResource($menu);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        if (request('web') == true) {
            return redirect(route('admin.menulist'));
        }
        return $menu;
    }
}
