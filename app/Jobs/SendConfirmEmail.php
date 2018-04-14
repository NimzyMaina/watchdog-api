<?php

namespace App\Jobs;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendConfirmEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    protected $link;

    protected $resendAfter = 24;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,$link)
    {
        $this->user = $user;
        $this->link = $link;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // -TODO = fancy looking email
        $fname = $this->user->first_name;
        $lname = $this->user->last_name;
        $email = $this->user->email;
        $link = $this->link;
        $message = "Hi $fname $lname! Welcome to the KPMG Mobile Device Resource Management (MDRM) Platform. Click on this link to activate your account $link .";
        if(Mail::raw($message, function ($mail) use ($email) {
            $mail->to($email);
            @$mail->subject('Email Verification');
        })){
            Log::info('Sent Email: email = ' .$this->user->email.' Link = ' .$this->link);
        }else{
            Log::error('Failed Email: email = ' .$this->user->email.' Link = ' .$this->link);
        }
    }
}
