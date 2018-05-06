<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DashController extends Controller
{

    public $data = [];

    /**
     * DashController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calls(Request $request)
    {
        $this->data['title'] = "View Calls";
        $this->data['subtitle'] = "See calls made on your phone";
        return view('pages.calls',$this->data);
    }

    public function getCalls(Request $request)
    {
        $user = $request->user();
        $calls = $user->calls()->get();
        return Datatables::of(collect($calls))
            ->editColumn('cost', function($call){
                return "KES " . $call->cost;
            })
            ->editColumn('duration', function($call){
                return number_format($call->cost). " sec";
            })
            ->make(true);

    }

    public function sms(Request $request)
    {
        $this->data['title'] = "View SMS";
        $this->data['subtitle'] = "See texts sent on your phone";
        return view('pages.sms',$this->data);
    }

    public function getSms(Request $request)
    {
        $user = $request->user();
        $sms = $user->sms()->get();
        return Datatables::of(collect($sms))
            ->make(true);
    }
}
