<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $cat_data = [
            'en' => ["name" => $request->en_name],
            'es' => ["name" => $request->es_name],
            "sort_order" => $request->sort_order,
            "menu_id" => $request->menu_id,
        ];
        if (isset($request->en_description)) {
            $cat_data['en']["description"] = $request->en_description;
            $cat_data['es']["description"] = $request->es_description;
        }
        $c = Category::create($cat_data);
        return redirect(route('menu.edit', $request->menu_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $data['category'] = $category;
        return view('admin.category.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $cat_data = [
            'en' => ["name" => $request->en_name],
            'es' => ["name" => $request->es_name],
            "sort_order" => $request->sort_order,
        ];
        if (isset($request->en_description)) {
            $cat_data['en']["description"] = $request->en_description;
            $cat_data['es']["description"] = $request->es_description;
        }
        $category->update($cat_data);
        return redirect(route('category.edit', $category->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route('menu.edit', request('menu_id')));

    }
}
