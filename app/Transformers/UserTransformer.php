<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

/**
 * Created by PhpStorm.
 * User: Maina
 * Date: 3/16/2018
 * Time: 5:32 PM
 */

class UserTransformer extends TransformerAbstract
{

    public function transform(User $user)
    {
        return [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'api_token' => $user->api_token
        ];
    }

}