<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Option::orderBy('sort_order')->get();
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
        $option_data = [
            'en'=> ["name" => $request->en_name],
            'es'=> ["name" => $request->es_name], 
            "sort_order"=>$request->sort_order, 
            "item_id"=> $request->item_id                  
        ];
        if (isset($request->price)) {
            $option_data['price'] = $request->price;
        }    
        if (isset($request->instructions)){
            $option_data['instructions'] = $request->instructions;
        }                                
        $o = Option::create($option_data);    
        return $o;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        return $option;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        $option_data = [
            'en'=> ["name" => $request->en_name],
            'es'=> ["name" => $request->es_name], 
            "sort_order"=>$request->sort_order, 
        ];
        if (isset($request->price)) {
            $option_data['price'] = $request->price;
        }    
        if (isset($request->instructions)){
            $option_data['instructions'] = $request->instructions;
        }                                
        $option->update($option_data);    
        return $option;    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return $option;
    }
}
