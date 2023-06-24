<?php

namespace App\Http\Controllers;

use App\Models\Option;
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
        $option_data = [
            'en' => ["name" => $request->en_name],
            'es' => ["name" => $request->es_name],
            "sort_order" => $request->sort_order,
            "item_id" => $request->item_id
        ];
        if (isset($request->price)) {
            $option_data['price'] = $request->price;
        }
        if (isset($request->instructions)) {
            $option_data['instructions'] = $request->instructions;
        }
        $o = Option::create($option_data);
        return redirect(route('item.edit', $request->item_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        $data['option'] = $option;
        return view('admin.option.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        $option_data = [
            'en' => ["name" => $request->en_name],
            'es' => ["name" => $request->es_name],
            "sort_order" => $request->sort_order,
        ];
        if (isset($request->price)) {
            $option_data['price'] = $request->price;
        }
        if (isset($request->instructions)) {
            $option_data['instructions'] = $request->instructions;
        }
        $option->update($option_data);
        return redirect(route('admin.item.edit', $request->item_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $option->delete();
        return redirect(route('admin.item.edit', request('item_id')));
    }
}
