<?php

namespace App\Http\Controllers;

use App\Models\Closing;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClosingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = Carbon::now('-6:00');
        // $today = Carbon::now('America/Mexico_City');
        $today->hour = 0;
        $today->minute = 0;
        $today->second = 0;

        $data['closings']=Closing::where('close_on', '>=', $today)->orderBy('close_on')->get();

        return view('admin.closing.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate();
        // $d = Carbon::now("-6:00");

        $d = new Carbon($request->date, "-6:00");

        // $d->year = $request->date_yy;
        // if ($d->year < 2000) {
        //     $d->year += 2000;
        // }
        // $d->month = $request->date_mm;
        // $d->day = $request->date_dd;
        // $d->hour = 0;
        // $d->minute = 0;
        // $d->second = 0;

        $closing_data = [
            'close_on'=>$d
        ];

        if (isset($request->en_title)) {
            $closing_data['en']["title"] = $request->en_title;
            $closing_data['es']["title"] = $request->es_title;
        }

        if (isset($request->en_message)) {
            $closing_data['en']["message"] = $request->en_message;
            $closing_data['es']["message"] = $request->es_message;
        }

        Closing::create($closing_data);

        return redirect(route('closing.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Closing  $closing
     * @return \Illuminate\Http\Response
     */
    public function show(Closing $closing)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Closing  $closing
     * @return \Illuminate\Http\Response
     */
    public function edit(Closing $closing)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Closing  $closing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Closing $closing)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Closing  $closing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Closing $closing)
    {
        $closing->delete();
        return redirect(route('closing.index'));
    }
}
