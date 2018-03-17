<?php

namespace App\Http\Controllers\Api;

use App\Sms;
use Illuminate\Http\Request;

class SmsController extends Controller
{

    /**
     * SmsController constructor.
     */
    public function __construct()
    {
        $this->middleware('api.auth');
    }

    public function store(Request $request)
    {
        $user = $this->user();

        $this->val($request->all(),[
            'id' => 'required',
            'reference' => 'required',
            'type' => 'required',
            'phone' =>'required',
            'time' => 'required',
            'charge_code' => 'present'
        ]);

        $data = $request->except('id');
        $data['user_id'] = $user->id;
        $data['sms_id'] = $request->id;

        if(Sms::create($data)){
            return $this->respond('Sms saved successfully');
        }
        return $this->respond('Unable to save sms',400);
    }
}
