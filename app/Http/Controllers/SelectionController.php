<?php

namespace App\Http\Controllers;

use App\Selection;
use Illuminate\Http\Request;

class SelectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Selection::orderBy('sort_order')->get();
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
        $sel_data = [
            'en'=> ["name" => $request->en_name],
            'es'=> ["name" => $request->es_name],
            "item_id"=> $request->item_id,
        ];
        $s = Selection::create($sel_data);   
        return $s;     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Selections  $selections
     * @return \Illuminate\Http\Response
     */
    public function show(Selection $selection)
    {
        return $selection;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Selections  $selections
     * @return \Illuminate\Http\Response
     */
    public function edit(Selection $selection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Selection  $selections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Selection $selection)
    {
        $sel_data = [
            'en'=> ["name" => $request->en_name],
            'es'=> ["name" => $request->es_name],
        ];
        $selection->update($sel_data);
        return $selection;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Selection  $selection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Selection $selection)
    {
        $selection->delete();
        return $selection;
    }
}
