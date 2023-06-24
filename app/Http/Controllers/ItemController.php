<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
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
        $item_data = [
            'en' => ["name" => $request->en_name],
            'es' => ["name" => $request->es_name],
            "price" => $request->price,
            "sort_order" => $request->sort_order,
            "category_id" => $request->category_id,
        ];
        if (isset($request->en_description)) {
            $item_data['en']["description"] = $request->en_description;
            $item_data['es']["description"] = $request->es_description;
        }
        if (isset($request->no_of_choices)) {
            $item_data["no_of_choices"] = $request->no_of_choices;
        }
        if (isset($request->instructions)) {
            $item_data['instructions'] = $request->instructions;
        }
        $i = Item::create($item_data);

        return redirect(route('category.edit', $request->category_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $data['item'] = $item;
        return view('admin.item.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item_data = [
            'en' => ["name" => $request->en_name],
            'es' => ["name" => $request->es_name],
            "price" => $request->price,
            "sort_order" => $request->sort_order,
        ];
        if (isset($request->en_description)) {
            $item_data['en']["description"] = $request->en_description;
            $item_data['es']["description"] = $request->es_description;
        }
        if (isset($request->no_of_choices)) {
            $item_data["no_of_choices"] = $request->no_of_choices;
        }
        if (isset($request->instructions)) {
            $item_data['instructions'] = $request->instructions;
        }
        $item->update($item_data);
        return redirect(route('category.edit', $item->category_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect(route('category.edit', request('category_id')));
    }
}
