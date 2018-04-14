<?php
/**
 * Created by PhpStorm.
 * User: Maina
 * Date: 4/14/2018
 * Time: 12:58 PM
 */

namespace App\Services;


use App\Jobs\SendConfirmEmail;
use App\Repositories\ActivationRepository;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Mail\Mailer;

class ActivationService
{
    use DispatchesJobs;

    protected $mailer;

    protected $activationRepo;

    protected $resendAfter = 24;

    /**
     * ActivationService constructor.
     * @param Mailer $mailer
     * @param ActivationRepository $activationRepo
     */
    public function __construct(Mailer $mailer, ActivationRepository $activationRepo)
    {
        $this->mailer = $mailer;
        $this->activationRepo = $activationRepo;
    }

    /**
     * Queue the welcome email
     * @param $user
     */
    public function sendActivationMail($user)
    {

        if ($user->activated || !$this->shouldSend($user))
        {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);

        $this->dispatch((new SendConfirmEmail($user,$link))->onQueue('emails'));

    }

    /**
     * Activate bearer of token
     * @param $token
     * @return $user
     */
    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;

    }

    public function activateUserViaOTP($code)
    {
        $activation = $this->activationRepo->getActivationByCode($code);

        if ($activation === null) {
            return null;
        }

        $user = User::whereUserUuid($activation->user_id)->first();

        $user->activated = true;
        $user->save();

        $this->activationRepo->deleteActivationCode($code);

        return $user;


    }

    /**
     * Check if token has expired
     * @param $user
     * @return bool
     */
    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }



}