<?php

namespace App\Http\Controllers\Api;

use App\Call;
use App\Tariff;
use Illuminate\Http\Request;


class CallsController extends Controller
{

    /**
     * CallsController constructor.
     */
    public function __construct()
    {
        $this->middleware('api.auth');
    }

    public function store(Request $request)
    {
        $user = $this->user();

        $this->val($request->all(),[
            'reference' => 'required',
            'type' => 'required',
            'phone' =>'required',
            'duration' => 'required',
            'start' => 'required',
            'end' => 'required',
            'charge_code' => 'present'
        ]);

        $request->merge([
            'phone' => standardizephone($request->phone)
        ]);

        $call_tariff = "Unknown";
        $call_charge = 0.00;
        $call_unit = 0.00;
        $tariffs = Tariff::all();

        foreach ($tariffs as $tariff)
        {
            if(preg_match($tariff->regex,$request->phone)){
                $call_tariff = $tariff->name;
                $call_charge = $tariff->charge;
                $call_unit = $tariff->unit;
                break;
            }
        }

        $data = $request->all();
        $data['user_id'] = $user->id;
        $data['tariff'] = $call_tariff;
        $data['cost'] = ($request->duration > 0)?$call_charge*($request->duration/$call_unit):0;
        if(Call::create($data)){
            return $this->respond('Call saved successfully');
        }
        return $this->respond('Unable to save call',400);
    }
}
