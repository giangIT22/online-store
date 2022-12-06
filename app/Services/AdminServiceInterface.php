<?php

namespace App\Services;

interface AdminServiceInterface
{
    public function getEmployees();
    public function searchEmployee($params);
    public function makeDataVerifyMail(string $email);
}
