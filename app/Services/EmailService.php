<?php
namespace App\Services;

use App\Contracts\EmailInterface;
use Illuminate\Support\Facades\Mail;
class EmailService implements EmailInterface
{
    public function SendEmail($email,$template)
    {
        Mail::to($email)->send($template);
    }
}
