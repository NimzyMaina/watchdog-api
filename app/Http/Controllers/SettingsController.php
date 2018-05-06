<?php

namespace App\Http\Controllers;

use App\Tariff;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->data['title'] = 'System Settings';
        $this->data['subtitle'] = 'Manage Call Tariffs';
        return view('pages.settings.tariffs',$this->data);
    }

    public function tariffData(Request $request)
    {
        $tariffs = Tariff::all();
        return Datatables::of(collect($tariffs))
            ->addColumn('action',function($user){
                return '<a href="'.route('user.edit',['id' => $user->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->make(true);

    }

    public function tariffCreate()
    {
        $this->data['title'] = 'System Settings';
        $this->data['subtitle'] = 'Add Call Tariff';
        $this->data['is_edit'] = false;
        return view('pages.settings.form',$this->data);
    }

    public function tariffStore(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'regex' => 'required',
            'priority' => 'required|numeric|min:0|max:5',
            'charge' => 'required|numeric|min:0',
            'unit' => 'required|numeric|min:0'
        ]);

        if(Tariff::create($request->all())){
            return back()->with('success','Tariff Created successfully');
        }
        return back()->with('error','Tariff Created successfully');

    }
}
