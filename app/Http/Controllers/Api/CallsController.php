<?php

namespace App\Http\Controllers\Api;

use App\Call;
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

        $data = $request->all();
        $data['user_id'] = $user->id;
        if(Call::create($data)){
            return $this->respond('Call saved successfully');
        }
        return $this->respond('Unable to save call');
    }
}
