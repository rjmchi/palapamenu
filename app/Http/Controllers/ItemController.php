<?php

namespace App\Http\Controllers;

use App\Item;
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
        return Item::orderBy('sort_order')->get();
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
            'en'=> ["name" => $request->en_name],
            'es'=> ["name" => $request->es_name], 
            "price"=> $request->price,
            "sort_order"=>$request->sort_order, 
            "category_id"=> $request->category_id,                  
        ];
        if (isset($request->en_description)){
            $item_data['en']["description"] = $request->en_description;
            $item_data['es']["description"] = $request->es_description;
        }
        if (isset($request->no_of_choices)){
            $item_data["no_of_choices"] = $request->no_of_choices;
        }                            
        if (isset($request->instructions)){
            $item_data['instructions'] = $request->instructions;
        }
        $i = Item::create($item_data);
        return $i;  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return $item;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item_data = [
            'en'=> ["name" => $request->en_name],
            'es'=> ["name" => $request->es_name], 
            "price"=> $request->price,
            "sort_order"=>$request->sort_order, 
        ];
        if (isset($request->en_description)){
            $item_data['en']["description"] = $request->en_description;
            $item_data['es']["description"] = $request->es_description;
        }
        if (isset($request->no_of_choices)){
            $item_data["no_of_choices"] = $request->no_of_choices;
        }                            
        if (isset($request->instructions)){
            $item_data['instructions'] = $request->instructions;
        }
        $item->update($item_data);
        return $item;     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return ($item);
    }
}
