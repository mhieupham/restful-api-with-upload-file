<?php
namespace App\Contracts;

interface EmailInterface{
    public function SendEmail($email,$template);
}
