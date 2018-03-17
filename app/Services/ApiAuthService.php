<?php

namespace App\Services;

use App\User;
use Dingo\Api\Auth\Provider\Authorization;
use Dingo\Api\Routing\Route;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


/**
 * Created by PhpStorm.
 * User: Maina
 * Date: 3/16/2018
 * Time: 5:12 PM
 */

class ApiAuthService extends Authorization
{

    /**
     * Authenticate the request and return the authenticated user instance.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Dingo\Api\Routing\Route $route
     *
     * @return mixed
     */
    public function authenticate(Request $request, Route $route)
    {
        $this->validateAuthorizationHeader($request);

        if($user = User::where('api_token',$request->bearerToken())->first()){
            return $user;
        }

        throw new UnauthorizedHttpException('','Unable to authenticate with the supplied api token.');

    }

    /**
     * Get the providers authorization method.
     *
     * @return string
     */
    public function getAuthorizationMethod()
    {
        return 'bearer';
    }
}