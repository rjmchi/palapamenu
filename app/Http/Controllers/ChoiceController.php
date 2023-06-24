<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use Illuminate\Http\Request;

class ChoiceController extends Controller
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
        if (!isset($request->sort_order)) {
            $request->sort_order = 0;
        }
        if (!isset($request->instructions)) {
            $request->instructions = false;
        }
        $choice_data = [
            'en' => ["name" => $request->en_name],
            'es' => ["name" => $request->es_name],
            "item_id" => $request->item_id,
            "sort_order" => $request->sort_order,
            "instructions" => $request->instructions
        ];

        $c = Choice::create($choice_data);
        return redirect(route('item.edit', $request->item_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function show(Choice $choice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function edit(Choice $choice)
    {
        $data['choice'] = $choice;
        return view('choice.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Choice $choice)
    {
        $choice_data = [
            'en' => ["name" => $request->en_name],
            'es' => ["name" => $request->es_name],
            "sort_order" => $request->sort_order,
            "instructions" => $request->has('instructions')
        ];

        $choice->update($choice_data);
        return redirect(route('item.edit', $request->item_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Choice  $choice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Choice $choice)
    {
        $choice->delete();
        return redirect(route('item.edit', request('item_id')));
    }
}
