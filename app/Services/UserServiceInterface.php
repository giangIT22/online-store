<?php

namespace App\Services;

interface UserServiceInterface
{
    public function makeDataVerifyMail(string $email);
}
