<?php

namespace App\Http\Controllers;

use App\Models\Closing;
use App\Models\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotOpenController extends Controller
{
    public function index()
    {
        $today = Carbon::now("-6:00");
        $today->hour = 0;
        $today->minute = 0;
        $today->second = 0;

        $closings=Closing::where('close_on', '=', $today)->first();

        $data['menus'] = Menu::orderBy('sort_order')->get();
        if ($closings){
            $data['special']= true;
            $data['special_title']=$closings->title;
            $data['special_message']= $closings->message;
        } else {
            $data['special']= false;
        }

        return view('notopen')->with($data);
    }
}
