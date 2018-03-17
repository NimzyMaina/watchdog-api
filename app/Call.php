<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call extends Model
{

    protected $fillable = ['reference','type','charge_code','phone','duration','start','end','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
