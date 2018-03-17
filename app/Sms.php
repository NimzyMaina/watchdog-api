<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $fillable = ['phone','type','charge_code','time','reference','sms_id','user_id'];
}
