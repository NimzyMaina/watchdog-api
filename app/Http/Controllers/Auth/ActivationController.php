<?php

namespace App\Http\Controllers\Auth;

use App\Services\ActivationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationController extends Controller
{
    private $activationService;

    public function __construct(ActivationService $activationService)
    {
        $this->activationService = $activationService;
    }

    /**
     * @param $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function activateUser($token)
    {
        if ($user = $this->activationService->activateUser($token)) {
            return "Activation successful! You can login to the app now.";
        }
        abort(404);
    }
}
