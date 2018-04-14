<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 12/8/2016
 * Time: 6:28 PM
 */

namespace App\Repositories;


use Carbon\Carbon;
use Illuminate\Database\Connection;

class ActivationRepository
{
    protected $db;

    protected $table = 'user_activations';

    protected $table2 = 'user_activation_otps';

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    protected function getCode()
    {
        return rand(100000,999999);
    }

    public function createActivation($user)
    {

        $activation = $this->getActivation($user);

        if (!$activation)
        {
            return $this->createToken($user);
        }
        return $this->regenerateToken($user);

    }

    public function createOTP($user)
    {
        $otp = $this->getOTP($user);

        if(!$otp)
        {
            return $this->createCode($user);
        }

        return $this->regenerateCode($user);
    }

    private function regenerateToken($user)
    {

        $token = $this->getToken();
        $this->db->table($this->table)->where('user_id', $user->id)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    private function regenerateCode($user)
    {
        $code = $this->getCode();
        $this->db->table($this->table2)->where('user_id', $user->id)->update([
            'token' => $code,
            'created_at' => new Carbon()
        ]);
        return $code;
    }

    private function createToken($user)
    {
        $token = $this->getToken();
        $this->db->table($this->table)->insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    private function createCode($user)
    {
        $code = $this->getCode();
        $this->db->table($this->table2)->insert([
            'user_id' => $user->id,
            'token' => $code,
            'created_at' => new Carbon()
        ]);
        return $code;
    }

    public function getActivation($user)
    {
        return $this->db->table($this->table)->where('user_id', $user->id)->first();
    }

    public function getOTP($user)
    {
        return $this->db->table($this->table2)->where('user_id',$user->id)->first();
    }

    public function getActivationByToken($token)
    {
        return $this->db->table($this->table)->where('token', $token)->first();
    }

    public function getActivationByCode($code)
    {
        return $this->db->table($this->table2)->where('token', $code)->first();
    }

    public function deleteActivation($token)
    {
        $this->db->table($this->table)->where('token', $token)->delete();
    }

    public function deleteActivationCode($code)
    {
        $this->db->table($this->table2)->where('token', $code)->delete();
    }
}